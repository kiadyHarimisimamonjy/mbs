<?php

namespace App\Http\Controllers;
class CrudController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:cruder|boss');

    }
}
