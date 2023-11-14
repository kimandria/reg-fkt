<?php

namespace App\Http\Controllers;

use App\Helpers;
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

class DistrictUserController extends Controller
{
    public function index()
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the district from the user
        $district = District::find($user->district_id);

        // Get the boroughs from the district
        $boroughs = Borough::where('district_id', $district->id)->get();

        // Count the fokontany in the boroughs
        $numFokontany = 0;
        foreach ($boroughs as $borough) {
            $numFokontany += Fokontany::where('borough_id', $borough->id)->count();
        }

        $district->boroughs = $boroughs;
        $district->num_boroughs = $boroughs->count();
        $district->num_fokontany = $numFokontany;

        return view('by_user_type.district', [
            'district' => $district,
        ]);
    }

    public function showBoroughDetails($id)
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the district from the user
        $district = District::find($user->district_id);

        // Redirect to unauthorized page if the borough does not belong to the district
        $borough = Borough::find($id);
        if ($borough->district_id != $district->id) {
            return redirect('/unauthorized');
        }

        // Show borough stats and member fokontany otherwise
        $borough->num_fokontany = Fokontany::where('borough_id', $borough->id)->count();
        $fokontany = Fokontany::where('borough_id', $borough->id)->get();
        $borough->fokontany = $fokontany;

        return view('details.borough', [
            'borough' => $borough,
        ]);
    }

    public function showFokontanyDetails($id)
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the district from the user
        $district = District::find($user->district_id);
        // Get the fokontany from the parameter
        $fokontany = Fokontany::find($id);

        // Redirect to unauthorized page if the fokontany does not belong to any of the district's boroughs
        $borough = Borough::find($fokontany->borough_id);
        if ($borough->district_id != $district->id) {
            return redirect('/unauthorized');
        }

        $fokontany = get_fokontany_details($fokontany);
        return view('details.fokontany', [
            'fokontany' => $fokontany,
        ]);
    }
}
