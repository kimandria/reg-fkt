<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Fokontany;
use App\Models\Borough;
use App\Models\District;
use App\Models\Prefecture;

class AdminController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        foreach ($users as $user) {
            // Use "N/A" as the default value for territory_label
            $user->territory_label = "N/A";
            if ($user->fkt_id) {
                $fokontany = Fokontany::find($user->fkt_id);
                if ($fokontany) {
                    $territory_label = $fokontany->name . " (fokontany)";
                    $user->territory_label = $territory_label;
                }
            }
            if ($user->borough_id) {
                $borough = Borough::find($user->borough_id);
                if ($borough) {
                    $territory_label = $borough->name . " (borough)";
                    $user->territory_label = $territory_label;
                }
            }
            if ($user->district_id) {
                $district = District::find($user->district_id);
                if ($district) {
                    $territory_label = $district->name . " (district)";
                    $user->territory_label = $territory_label;
                }
            }
            if ($user->prefecture_id) {
                $prefecture = Prefecture::find($user->prefecture_id);
                if ($prefecture) {
                    $territory_label = $prefecture->name . " (prefecture)";
                    $user->territory_label = $territory_label;
                }
            }
        }

        return view('admin.users', compact('users'));
    }

    public function showCreateUserForm()
    {
        $fokontanies = Fokontany::all();
        $boroughs = Borough::all();
        $districts = District::all();
        $prefectures = Prefecture::all();
        return view('admin.createuser', compact('fokontanies', 'boroughs', 'districts', 'prefectures'));
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:8',
            'is_admin' => 'nullable|boolean',
            'fokontany' => 'nullable|exists:fokontanies,id',
            'borough' => 'nullable|exists:boroughs,id',
            'district' => 'nullable|exists:districts,id',
            'prefecture' => 'nullable|exists:prefectures,id',
        ]);

        $user = new User;
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->is_admin = $request->has('is_admin');
        $user->fkt_id = $validatedData['fokontany'];
        $user->borough_id = $validatedData['borough'];
        $user->district_id = $validatedData['district'];
        $user->prefecture_id = $validatedData['prefecture'];
        $user->save();

        Session::flash('success', 'User created successfully!');
        return redirect('/admin/users');
    }
}
