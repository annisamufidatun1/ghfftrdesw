<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class settingsController extends Controller
{

    public function reportbugform()
    {
        return view('user.reportbugform');
    }

    public function settings()
    {
        return view('user.settings');
    }
    public function reportbugsuccess()
    {
        return view('user.reportbugsuccess');
    }
    public function aboutus()
    {
        return view('user.aboutus');
    }
    public function editprofile()
    {
        return view('user.editprofile');
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'reportdate' => 'required',
            'reportdetails'=> 'required'
        ]);
        DB::table('reportbug')->insert([
            'date' => $validatedData['reportdate'],
            'reportdetails' => $validatedData['reportdetails'],
        ]);
        return view('user.reportbugsuccess');
    }
}

