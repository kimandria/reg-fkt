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

class BouroughUserController extends Controller
{
    public function index()
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the borough from the user
        $borough = Borough::find($user->borough_id);

        // Get the fokontany from the borough
        $fokontany = Fokontany::where('borough_id', $borough->id)->get();
        $borough->fokontany = $fokontany;

        // Count the fokontany in the borough
        $numFokontany = Fokontany::where('borough_id', $borough->id)->count();
        $borough->num_fokontany = $numFokontany;

        return view('by_user_type.borough', [
            'borough' => $borough,
        ]);
    }

    public function showFokontanyDetails($id)
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the borough from the user
        $borough = Borough::find($user->borough_id);

        // Get the fokontany from the parameter
        $fokontany = Fokontany::find($id);

        // Redirect to unauthorized page if the fokontany does not belong to the borough
        if ($fokontany->borough_id != $borough->id) {
            return redirect('/unauthorized');
        }

        $fokontany = get_fokontany_details($fokontany);
        return view('details.fokontany', [
            'fokontany' => $fokontany,
        ]);
    }
}
