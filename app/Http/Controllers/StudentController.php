<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class StudentController extends Controller
{
    public function index()
    {
        return student::all();
    }


    public function showid()
    {
        return student::find(request('id'));
    }

    public function addstudent(Request  $request)
    {
    $request->validate([
        'name'  => 'required',
        'city'  => 'required',
        'fees'  => 'required',
    ]);

    $student=student::create([
        'name'  => $request->name,
        'city'  => $request->city,
        'fees'  => $request->fees,
    ]);


    if ($student) {
        return response([
            'message' => 'has been inserted',
            'status' => "400",
        ]);
    }
}


    public function updatebyID(Request $request)
    {
        $student=student::find(request('id'));
        $student->update($request->all());
        if ($student) {
            return response([
                'message' => 'has been updated',
                'status' => "400",
            ]);
        }
    }

    public function deletebyID(Request $request)
    {
        $del=student::find(request('id'));
        $a=$del->delete();

        if ($a) {
            return response([
                'message' => 'has been deleted Againt Id no '.$del->id,
                'status' => "400",
            ]);
        }
    }

    public function searchbyCity($city)
    {
        return student::where('city',$city)->get();
    }







}
