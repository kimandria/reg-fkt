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
        $users = User::orderBy('username', 'asc')->paginate(6);
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

        Session::flash('message', 'User created successfully!');
        return redirect('/admin/users');
    }

    public function showEditUserForm($id)
    {
        $user = User::find($id);
        if ($user) {
            $fokontanies = Fokontany::all();
            $boroughs = Borough::all();
            $districts = District::all();
            $prefectures = Prefecture::all();
            return view('admin.edituser', compact('user', 'fokontanies', 'boroughs', 'districts', 'prefectures'));
        } else {
            Session::flash('error', 'User not found!');
            return redirect('/admin/users');
        }
    }

    public function editUser(Request $request)
    {
        // Set is_admin to false if it is not set
        if (!$request->has('is_admin')) {
            $request->merge(['is_admin' => false]);
        }

        $validatedData = $request->validate([
            'id' => 'required|exists:users,id',
            'username' => 'required|unique:users,username,' . $request->id . '|max:255',
            'email' => 'required|unique:users,email,' . $request->id . '|max:255',
            'password' => 'nullable|min:8',
            'is_admin' => 'nullable|boolean',
            'fokontany' => 'nullable|exists:fokontanies,id',
            'borough' => 'nullable|exists:boroughs,id',
            'district' => 'nullable|exists:districts,id',
            'prefecture' => 'nullable|exists:prefectures,id',
        ]);

        // At least one of fokontany, borough, district, or prefecture must be set if is_admin is false
        if (!$validatedData['is_admin']) {
            if (!$validatedData['fokontany'] && !$validatedData['borough'] && !$validatedData['district'] && !$validatedData['prefecture']) {
                Session::flash('error', 'At least one of fokontany, borough, district, or prefecture must be set if is_admin is false!');
                return redirect('/admin/users');
            }
        }

        $user = User::find($validatedData['id']);
        if ($user) {
            $user->username = $validatedData['username'];
            $user->email = $validatedData['email'];
            if ($validatedData['password']) {
                $user->password = bcrypt($validatedData['password']);
            }
            $user->is_admin = $request->has('is_admin');
            $user->fkt_id = $validatedData['fokontany'];
            $user->borough_id = $validatedData['borough'];
            $user->district_id = $validatedData['district'];
            $user->prefecture_id = $validatedData['prefecture'];
            $user->save();

            Session::flash('message', 'User updated successfully!');
        } else {
            Session::flash('error', 'User not found!');
        }
        return redirect('/admin/users');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            Session::flash('message', 'User deleted successfully!');
        } else {
            Session::flash('error', 'User not found!');
        }
        return redirect('/admin/users');
    }
}

