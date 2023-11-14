<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Prefecture;
use App\Models\District;
use App\Models\Borough;
use App\Models\Fokontany;
use App\Models\Book;
use App\Models\Citizens;
use App\Models\Movement;
use App\Models\Child;

class FokontanyUserController extends Controller
{
    public function index()
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the fokontany from the user
        $fokontany = Fokontany::find($user->fkt_id);

        $fokontany = get_fokontany_details($fokontany);

        return view('by_user_type.fokontany', [
            'fokontany' => $fokontany,
        ]);
    }
}
