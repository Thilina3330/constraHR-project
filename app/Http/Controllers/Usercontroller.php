<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class Usercontroller extends Controller
{
        public function index(){

           $users=User::all();
           return view('user_management.view_user');


        }

}
