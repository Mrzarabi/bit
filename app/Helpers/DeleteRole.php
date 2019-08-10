<?php

namespace App\Helpers;

use App\Role;

trait DeleteRole
{
    /**
     * Find an get a data from Database and Delete it or them
     *
     * @param ID $feature
     * @return Model
     */
    public function destroy($data)
    {
        $this->checkPermission("delete-{$this->type}");
        
        if ( request()->has('selected') )
            $result = $this->model::whereIn('id', request()->selected)->where('name', '!=', 'owner')->delete();
        else 
            $result = $this->model::where('id', $data)->where('name', '!=', 'owner')->delete();

        if ( $result )
            return redirect(route("{$this->type}.index"))->with('message', request()->has('selected') ? "موارد انتخاب شده با موفقیت حذف شد" : "با موفقیت حذف شد");
        else
            return redirect(route("{$this->type}.index"))->withErros(["متاسفانه هیچ داده ای یافت نشد"]);
    }
}