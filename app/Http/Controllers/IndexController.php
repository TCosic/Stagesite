<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tool;

use App\Http\Requests;

class IndexController extends Controller
{
    public function index(){
        $tool = Tool::findOrFail(1);
        dd($tool->internship_user->user);

        return view('test', compact('tool'));
    }
}
