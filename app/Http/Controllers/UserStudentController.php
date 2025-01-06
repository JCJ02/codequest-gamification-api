<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserStudentController extends Controller
{
    // User Student Controller
    public function register() {
        return view("Register");
    }
}
