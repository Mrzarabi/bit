<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Option;
use App\Models\Order;
use Cookie;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Models\Grouping\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Grouping\Subject;
use App\Helpers\ImageTools;

// use App\Models\ProductVariation;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ImageTools;

    public static function options($items)
    {
        return Option::select('name', 'value')
            ->whereIn('name', $items)
            ->get()
            ->keyBy('name')
            ->map(function ($item) {
                if ( in_array($item['name'] , [ 'slider', 'posters', 'social_link', 'shipping_cost' ]) )
                {
                    return json_decode( $item['value'] );
                }
                return $item['value'];
        });
    }

    /**
     * Get a breadcrump for specified group
     *
     * @param Integer $category
     * @return Array
     */
    public function breadcrumb(Category $category)
    {
        if (is_null($category->parent)) return [ $category ];
        
        $i = 1;
        $groups = [ $category ];
        do {
            $groups[$i++] = $groups[ count($groups) - 1 ]->parent_group()->first();
        } while ($groups[$i - 1]->parent);

        return $groups;
    }

    public function Get_sub_groups()
    {
        return Category::whereNull('parent')->with([
            'childs:id,parent,title,description,logo',
            'childs.childs:id,parent,title,description,logo',
            'childs.childs.childs:id,parent,title,description,logo',
        ])->get();
    }

    /**
     * Get a request with a file and upload it's file,
     * then return the same request with uploaded file names
     *
     * @param Request $request
     * @param string $field_name
     * @param Model $model
     * @return Request
     */
    public function requestWithImage($request, $field_name = 'image', $model = null)
    {
        if ( !$request->hasFile($field_name) )
            return $request;

        if ( $model && $model->$field_name && file_exists( public_path($model->$field_name) ) )
                unlink( public_path($model->$field_name) );

        return collect( array_merge( $request->except($field_name), [
            $field_name => $this->upload_image( $request->file( $field_name ) )
        ]) );
    }

    public static function upload_image ($image, $crop = 300, $watermark = null)
    {
        // Create file name & file path with /year/month/day/filename formats
        $time = Carbon::now();   
        $file_path = "uploads/{$time->year}/{$time->month}/{$time->day}";
        $file_ext = $image->getClientOriginalExtension();
        $file_name = rtrim($image->getClientOriginalName(), ".$file_ext");
        $file_name = time() . '_' . substr($file_name, 0, 30);
        
        // Create directories if doesn't exists
        if (!file_exists( public_path($file_path) )) {
            mkdir(public_path($file_path), 0777, true);
        }
        
        // Reszie and upload the image to storge
        $image = Image::make( $image );
        $image->resize($crop, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        if ( $watermark && file_exists( $watermark ) )
        {
            $watermark = Image::make( $watermark );
            $ratio = $watermark->width() / $watermark->height();
            $watermark->resize(50 * $ratio, 50);
            $image->insert($watermark, 'bottom-right', 10, 10);
        }

        $image->save( public_path("$file_path/$file_name.$file_ext") );
        return "/$file_path/$file_name.$file_ext";
    }
    /**
     * Get a request with a file and upload it's file,
     * then return the same request with uploaded file names
     *
     * @param Request $request
     * @param string $field_name
     * @param Model $model
     * @return Request
     */
    public function requestWithGallery($request, $field_name = 'gallery', $model = null)
    {
        $gallery = [];
                
        if ( $model->$field_name ?? false )
            $gallery = array_merge( $gallery, $model->$field_name );

        if ($request->deleted_images)
        {
            foreach ($request->deleted_images as $item )
            {
                foreach ( $gallery[$item] ?? [] as $image )
                {
                    if( file_exists( public_path( $image ) ) )
                        unlink( public_path( $image ) );
                
                    if ( isset( $gallery[$item] ) ) unset( $gallery[$item] );
                }
            }
        }

        if ( $request->has($field_name) )
        {
            foreach ( $request->$field_name as $file )
                $gallery[] = $this->upload_image( $file );
        }

        return collect( array_merge( $request->except($field_name), [
            $field_name => $gallery
        ]) );
    }

    /**
     * Check the user permision to access a request,
     * abort 403 status code or access deny if hadn't
     *
     * @param string $permission
     * @return void
     */
    public function checkPermission(string $permission)
    {
        if ( !auth()->check() || !auth()->user()->can($permission) )
            return abort(403);
    }
}