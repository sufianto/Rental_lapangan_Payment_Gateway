<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtmlController extends Controller
{
    public function getlorem()
    {
        return view('v_html.getlorem');
    }
}
