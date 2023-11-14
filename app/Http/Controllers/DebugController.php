<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index()
    {
        $allFunctions = get_defined_functions();
        $userFunctions = $allFunctions['user']; // get user-defined functions

        // print_r($userFunctions);
        return response()->json($userFunctions);
    }
}
