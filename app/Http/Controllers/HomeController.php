<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //classes
    public function classform()
    {
        return view('/Classes&subjects/classform');
    }
    public function classedit()
    {
        return view('/Classes&subjects/classedit');
    }
    public function classshow()
    {
        return view('/Classes&subjects/classshow');
    }
    public function singleclass()
    {
        return view('/Classes&subjects/singleclass');
    }

    //subjects
    public function subjectform()
    {
        return view('/Classes&subjects/subjectform');
    }
    public function editsubject()
    {
        return view('/Classes&subjects/editsubject');
    }
    public function subjectshow()
    {
        return view('/Classes&subjects/subjectshow');
    }
    public function singlesubject()
    {
        return view('/Classes&subjects/singlesubject');
    }
    
    //students
    public function studentreg()
    {
        return view('/students/studentreg');
    }
    public function editstudent()
    {
        return view('/students/editstudent');
    }
    public function studentshow()
    {
        return view('/students/studentshow');
    }
    public function singlestudent()
    {
        return view('/students/singlestudent');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
