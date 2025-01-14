<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function getTabel()
    {
        return view('v_html.getTabel');
    }
    public function getForm()
    {
        return view('v_html.getForm');
    }
}
