<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;


class SiteController extends Controller
{
    public function index()
    {
        return view("site.create");

    }
    public function store(Request $request){

    $request->validate([
        'site_name'=>'required|string|max:255',
        'start_date'=>'required|date',
        'end_date'=>'required|date',
        'location'=>'required|string|max:50',
        'site_engineer_id'=>'required',



    ]);

     Site::create($request->all());
     return redirect()->back()->with('success','the site create successfull');


    }

}

