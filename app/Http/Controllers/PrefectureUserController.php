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

class PrefectureUserController extends Controller
{
    public function index()
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the prefecture from the user
        $prefecture = Prefecture::find($user->prefecture_id);

        // Get the districts from the prefecture
        $districts = District::where('prefecture_id', $prefecture->id)->get();
        $prefecture->districts = $districts;

        // Count the boroughs in the districts
        $numBoroughs = 0;
        foreach ($districts as $district) {
            $numBoroughs += Borough::where('district_id', $district->id)->count();
        }

        // Count the fokontany in the boroughs
        $numFokontany = 0;
        foreach ($districts as $district) {
            $boroughs = Borough::where('district_id', $district->id)->get();
            foreach ($boroughs as $borough) {
                $numFokontany += Fokontany::where('borough_id', $borough->id)->count();
            }
        }

        $prefecture->districts = $districts;
        $prefecture->num_districts = $districts->count();
        $prefecture->num_boroughs = $numBoroughs;
        $prefecture->num_fokontany = $numFokontany;

        return view('by_user_type.prefecture', [
            'prefecture' => $prefecture,
        ]);
    }

    public function showDistrictDetails($id)
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the prefecture from the user
        $prefecture = Prefecture::find($user->prefecture_id);

        // Find the district using the parameter
        $district = District::find($id);

        // Redirect to unauthorized page if the district does not belong to the prefecture
        if ($district->prefecture_id != $prefecture->id) {
            return redirect('/unauthorized');
        }

        // Show district stats and member boroughs otherwise
        // $district->num_boroughs = Borough::where('district_id', $district->id)->count();
        $boroughs = Borough::where('district_id', $district->id)->get();
        $district->boroughs = $boroughs;
        $district->num_boroughs = $boroughs->count();

        // Count the fokontany in the boroughs
        $numFokontany = 0;
        foreach ($boroughs as $borough) {
            $numFokontany += Fokontany::where('borough_id', $borough->id)->count();
        }
        $district->num_fokontany = $numFokontany;

        return view('details.district', [
            'district' => $district,
        ]);
    }

    public function showBoroughDetails($id)
    {
        // Get the user from cookie
        $userId = Cookie::get('user_id');
        $user = User::find($userId);

        // Get the prefecture from the user
        $prefecture = Prefecture::find($user->prefecture_id);

        // Redirect to unauthorized page if the district does not belong to the prefecture
        $borough = Borough::find($id);
        $district = District::find($borough->district_id);
        if ($district->prefecture_id != $prefecture->id) {
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

        // Get the prefecture from the user
        $prefecture = Prefecture::find($user->prefecture_id);
        // Get the fokontany from the parameter
        $fokontany = Fokontany::find($id);

        // Redirect to unauthorized page if the fokontany does not belong to the prefecture
        $borough = Borough::find($fokontany->borough_id);
        $district = District::find($borough->district_id);
        if ($district->prefecture_id != $prefecture->id) {
            return redirect('/unauthorized');
        }

        $fokontany = get_fokontany_details($fokontany);
        return view('details.fokontany', [
            'fokontany' => $fokontany,
        ]);
    }
}
