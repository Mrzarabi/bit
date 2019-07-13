<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\Grouping\Subject;
use App\Http\Requests\V1\Grouping\SubjectRequest;
use Illuminate\Support\Facades\Input;

class SubjectController extends Controller
{
    /**
     * Display a listing of the subject.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.subject', [
            'subjects' => Subject::latest()->paginate(10),
            'page_name' => 'subject',
            'page_title' => 'گروه بندی محصولات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Subject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Subject in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Grouping\SubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        Subject::create(array_merge($request->all(), [
            'logo' => $request->hasFile('logo') ? $this->upload_image( Input::file('logo') ) : null,
        ]));
        
        return redirect()->back()->with('message', 'گروه '.$request->title.' با موفقیت ثبت شد .');
    }

    /**
     * Display the specified Subject.
     *
     * @param  \App\models\Grouping\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified Subject.
     *
     * @param  \App\models\Grouping\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('panel.subject', [
            'id' => $subject->id,
            'subject' => $subject,
            'subjects' => Subject::all(),
            'page_name' => 'subject',
            'page_title' => 'ویرایش گروه ' . $subject->title,
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified Subject in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Grouping\SubjectRequest  $request
     * @param  \App\models\Grouping\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        if ($request->hasFile('logo'))
        {
            $logo = $this->upload_image( Input::file('logo') );
            
            if ( file_exists( public_path($subject->logo) ) )
                unlink( public_path($subject->logo) );
        }
        else
        {
            $logo = $subject->logo;
        }
                
        $subject->update(array_merge($request -> all(), [
            'logo' => $logo
        ]));
        return redirect(route('subject.index'))->with('message', 'گروه '.$request->title.' با موفقیت بروز رسانی شد .');
    }

    /**
     * Remove the specified Subject from storage.
     *
     * @param  \App\models\Grouping\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        
        return redirect( route('subject.index') )->with('message', 'گروه '.$subject->title.' با موفقیت حذف شد .');
    }
}
