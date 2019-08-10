<?php

namespace App\Http\Controllers\panel;

use App\Models\Grouping\Subject;
use App\Http\Requests\V1\Grouping\SubjectRequest;
use App\Http\Controllers\MainController;

class SubjectController extends MainController
{

    /**
     * Type of this controller for use in messages
     *
     * @var string
     */
    protected $type = 'subject';

    /**
     * The model of this controller
     *
     * @var Model
     */
    protected $model = Subject::class;

    /**
     * The request class for this controller
     *
     * @var Model
     */
    protected $request = SubjectRequest::class;

    /**
     * Name of the views that need by this controller
     *
     * @var string
     */
    protected $views = [
        'index' => 'panel.subject',
        'show'  => 'panel.subject',
    ];

    /**
     * Name of the field that should upload an image from that
     *
     * @var string
     */
    protected $image_field = 'logo';

    /**
     * Update the specified Subject in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Grouping\SubjectRequest  $request
     * @param  \App\models\Grouping\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    // public function update(SubjectRequest $request, Subject $subject)
    // {
    //     if ($request->hasFile('logo'))
    //     {
    //         $logo = $this->upload_image( Input::file('logo') );
            
    //         if ( file_exists( public_path($subject->logo) ) )
    //             unlink( public_path($subject->logo) );
    //     }
    //     else
    //     {
    //         $logo = $subject->logo;
    //     }
                
    //     $subject->update(array_merge($request -> all(), [
    //         'logo' => $logo
    //     ]));
    //     return redirect(route('subject.index'))->with('message', 'گروه '.$request->title.' با موفقیت بروز رسانی شد .');
    // }

    /**
     * Remove the specified Subject from storage.
     *
     * @param  \App\models\Grouping\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Subject $subject)
    // {
    //     $subject->delete();
        
    //     return redirect( route('subject.index') )->with('message', 'گروه '.$subject->title.' با موفقیت حذف شد .');
    // }
}
