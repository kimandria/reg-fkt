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
use Illuminate\Support\Facades\Session;

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

        $citizens = Citizens::orderBy('last_name', 'asc')->paginate(8);

        return view('by_user_type.fokontany', [
            'fokontany' => $fokontany,
            'citizens' => $citizens
        ]);
    }

    public function addCitizens(Request $request)
    {
        try {
            $citizen = new Citizens();
            $citizen->first_name = $request->input('firstname');
            $citizen->last_name = $request->input('name');
            $citizen->job = $request->input('job');
            $citizen->nic_place = $request->input('nic_place');
            $citizen->birth_date = $request->input('birth_date');
            $citizen->birth_place = $request->input('birth_place');
            $citizen->father = $request->input('father');
            $citizen->mother = $request->input('mother');
            $citizen->email = $request->input('email');
            $citizen->phone_num = $request->input('phone_num');
            $citizen->nic_num = $request->input('cin');
            $citizen->nic_date = $request->input('nic_date');

            $citizen->save();

            Session::put('message', 'Citizens added successfully');

           return redirect('/fokontany/citizens', compact('citizen'));
        } catch (\Exception $e) {
            Session::put('error', 'Failed to add Citizens.');
            return view('by_user_type.fokontany');
        }
    }
    public function updateCitizens(Request $request)
    {
        $request->validate([
            $request->validate([
                'firstname' => 'required',
                'name' => 'required',
                'job' => 'required',
                'nic_place' => 'required',
                'birth_date' => 'required',
                'phone_num' => 'required',
                'email' => 'required',
                'birth_place' => 'required',
                'father' => 'required',
                'mother' => 'required',
                'cin' => 'required',
                'nic_date' => 'required'
            ])
        ]);

        $citizen = Citizens::find($request->id);

        if (!$citizen) {
            return redirect('/fokontany')->with('error', 'Citizens not found');
        }
        $citizen->first_name = $request->input('firstname');
        $citizen->last_name = $request->input('name');
        $citizen->job = $request->input('job');
        $citizen->nic_place = $request->input('nic_place');
        $citizen->birth_date = $request->input('birth_date');
        $citizen->father = $request->input('father');
        $citizen->email = $request->input('email');
        $citizen->mother = $request->input('mother');
        $citizen->phone_num = $request->input('phone_num');
        $citizen->nic_num = $request->input('cin');
        $citizen->nic_date = $request->input('nic_date');
        $citizen->birth_place = $request->input('birth_place');

        $citizen->save();

        Session::put('message', 'Citizens updated successfully');
        return redirect('/fokontany/citizens');
    }
    public function editcitizens($id)
    {
        $citizen = Citizens::find((int)$id);
        if (!$citizen) {
            return redirect('/fokontany')->with('error', 'Citizens not found');
        }
        return view('by_user_type.editcitizens', compact('citizen'));
    }
    public function deletecitizens($id)
    {
        $citizen = Citizens::find((int)$id);
        if (!$citizen) {
            return redirect('/fokontany')->with('error', 'Citizens not found');
        }
        $citizen->delete();
        Session::put('message', 'Citizens deleted successfully');
        return redirect('/fokontany/citizens');
    }
    public function listcitizens()
    {
        $citizens = Citizens::orderBy('last_name', 'asc')->paginate(8);
        return view('by_user_type.listCitizens', compact('citizens'));
    }

    // Book
    public function Book()
    {
        $book = Book::orderBy('num', 'asc')->paginate(3);
        $fkt = Fokontany::orderBy('name', 'asc')->get();
        $citizens = Citizens::orderBy('first_name', 'asc')->get();
        return view('by_user_type.add_book', compact('book', 'fkt', 'citizens'));
    }

    public function addBook(Request $request)
    {
        try {
            $book = new Book();
            $book->num = $request->input('book_num');
            $book->fokontany_id = $request->input('fkt_id');
            $book->first_head_id = $request->input('first_head_id');
            $book->second_head_id = $request->input('second_head_id');
            $book->save();

            Session::put('message', 'The Book number ' . $request->book_num . ' was added with success');
            return redirect('/fokontany/book');
        } catch (\Exception $e) {
            Session::put('error', 'Failed to add Book. Please try again and select a name.');
            return redirect('/book');
        }
    }
    //edit book
    public function editBook($id)
    {
        $book = Book::find((int)$id);
        if (!$book) {
            return redirect('/fokontany/book')->with('error', 'Book not found');
        }
        $fkt = Fokontany::orderBy('name', 'asc')->get();
        $citizens = Citizens::orderBy('first_name', 'asc')->get();
        return view('by_user_type.edit_book', compact('book', 'fkt', 'citizens'));
    }
    //update book
    public function updateBook(Request $request)
    {
        $book = Book::find($request->id);

        if (!$book) {
            Session::put('error', 'book not found');
            return redirect('/fokontany/book');
        }

        $book->num = $request->input('book_num');
        $book->fokontany_id = $request->input('fkt_id');
        $book->first_head_id = $request->input('first_head_id');
        $book->second_head_id = $request->input('second_head_id');
        $book->save();

        if ($request->input('selectedChildrenIds') == null) {
            Session::put('message', 'The book number ' . $request->book_num . ' updated with success');
            return redirect('/fokontany/book');
        }
        if (!empty($request->input('selectedChildrenIds'))) {
            $childrenIds = json_decode($request->input('selectedChildrenIds'));

            foreach ($childrenIds as $childId) {
                $validatedChildId = intval($childId);

                $citizen = Citizens::find($validatedChildId);

                if ($citizen) {
                    $child = new Child();
                    $child->book_id = $book->id;
                    $child->citizen_id = $validatedChildId;
                    $child->save();
                } else {
                    Session::put('error', 'the child id ' . $validatedChildId . ' is not valide');
                    return redirect('/fokontany/book');
                }
            }
        } else {
            Session::put('error', 'please select a child');
            return redirect('/fokontany/book');
        }

        Session::put('message', 'The book number ' . $request->book_num . ' updated with success');
        return redirect('/fokontany/book');
    }
    //delete book
    public function deleteBook($id)
    {
        $book = Book::find($id);

        if (!$book) {
            Session::put('error', 'book not found');
            return redirect('/fokontany/book');
        }
        $children = Child::where('book_id', $book->id)->get();
        foreach ($children as $child) {
            $child->delete();
        }
        $book->delete();
        Session::put('message', 'book deleted');
        return redirect('/fokontany/book');
    }
    //movement
    public function showMovement()
        {
            $movement = Movement::orderBy('book_id', 'asc')->paginate(5);
            $book = Book::orderBy('num', 'asc')->get();
            $fkt = Fokontany::orderBy('name', 'asc')->get();
            return view('by_user_type.add_movement', compact('movement', 'book', 'fkt'));
        }
        public function addMovement(Request $request)
    {
        try {
            $movement = new Movement();
            $movement->book_id = $request->input('book_id');
            $movement->from_fkt_id = $request->input('fokontany_id');
            $movement->to_fkt_id = $request->input('fkt_id');
            $movement->pending = true;
            $movement->departure_date = $request->input('departure_date');
            $movement->arrival_date = $request->input('arrival_date');
            $movement->save();

            Session::put('message', 'The movement was added with success');
            return redirect('/fokontany/movement/list')->with('movement', $movement);
        } catch (\Exception $e) {
            Session::put('error', 'Failed to add movement. Please try again and select a name.');
            return redirect('/fokontany/movement');
        }
    }
    public function listMovement()
    {
        $movement = Movement::paginate(5);
        return view('by_user_type.movement_list', compact('movement'));
    }
    public function updateMovement(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'fokontany_id' => 'required',
            'fkt_id' => 'required',
            'departure_date' => 'required',
        ]);

        $movement = Movement::find($request->movement_id);

        if (!$movement) {

            Session::put('error', 'Movement not found');
            return redirect('/fokontany/movement');
        }

        $movement->book_id = $request->input('book_id');
        $movement->from_fkt_id = $request->input('fokontany_id');
        $movement->to_fkt_id = $request->input('fkt_id');
        $movement->pending = $request->input('pending');
        $movement->departure_date = $request->input('departure_date');
        $movement->arrival_date = $request->input('arrival_date');
        $movement->save();

        Session::put('message', 'The movement was updated with success');
        return redirect('/fokontany/movement/list');
    }
    //edit movement
    public function editMovement($id)
    {
        $movement = Movement::find((int)$id);
        $book = Book::orderBy('num', 'asc')->get();
        $fkt = Fokontany::orderBy('name', 'asc')->get();
        return view('by_user_type.edit_Movement', compact('movement', 'book', 'fkt'));
    }
    //delete movement
    public function deleteMovement($id)
    {
        $movement = Movement::find((int)$id);
        if (!$movement) {
            return redirect('/fokontany/movement')->with('error', 'Movement not found');
        }
        $movement->delete();
        Session::put('message', 'Movement deleted successfully');
        return redirect('/fokontany/movement/list');
    }
}
