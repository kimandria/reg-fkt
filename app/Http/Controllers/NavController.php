<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Prefecture;
use App\Models\District;
use App\Models\Borough;
use App\Models\Fokontany;
use App\Models\Citizens;
use App\Models\Book;
use App\Models\Child;

class NavController extends Controller
{
    public function index () {
        return view('index');
    }

    public function prefecture () {
        $prefet = Prefecture::orderBy('name', 'asc') ->paginate(3);
        return view('prefecture')->with('prefet',$prefet);
    }

    public function district() {
        $districts = District::orderBy('name', 'asc')->paginate(3);
        $prefectures = Prefecture::orderBy('name', 'asc')->get();
        return view('district', compact('districts', 'prefectures'));
    }

    public function borough () {
        $boroughs = Borough::orderBy('name', 'asc')->paginate(3);
        $districts = District::orderBy('name', 'asc')->get();
        return view('borough', compact('boroughs', 'districts'));
    }
    public function fonkotany () {
        $fkt = Fokontany::orderBy('name', 'asc')->paginate(3);
        $boroughs = Borough::orderBy('name', 'asc')->get();
        return view('fonkotany', compact('fkt', 'boroughs'));
    }

    public function citizens () {
        $citizens = Citizens::orderBy('last_name', 'asc')->paginate(6);
        return view('citizens', compact('citizens'));
    }
    public function book () {
        $book = Book::orderBy('first_head_id', 'asc')->paginate(2);
        $fkt = Fokontany::orderBy('name', 'asc')->get();
        $citizens = Citizens::orderBy('first_name', 'asc')->get();
        return view('book', compact('book', 'fkt', 'citizens'));
    }

 //--------------------------------------------------//------------------------------------------------
    //Prefecture function
    // public function show($id) {
    //     $showpref = Prefecture::find($id);
    //     return view('showpref')->with('showpref', $showpref);
    // }

    public function show($id) {
        $prefecture = Prefecture::find($id);
        $districts = District::where('prefecture_id', $id)->get();
        $boroughs = Borough::whereIn('district_id', $districts->pluck('id'))->get();
        $fokontanies = Fokontany::whereIn('borough_id', $boroughs->pluck('id'))->get();

        return view('showpref')->with('prefecture', $prefecture)
                              ->with('districts', $districts)
                              ->with('boroughs', $boroughs)
                              ->with('fokontanies', $fokontanies);
    }

    public function savepref(Request $request) {
        try {
            $prefecture = new Prefecture();
            $prefecture->name = $request->input('prefecture_name');
            $prefecture->save();

            Session::put('message', 'The prefecture ' . $request->prefecture_name . ' was added with success');
        } catch (\Exception $e) {
            Session::put('error', 'Failed to add the prefecture. Please try again later.');
        }

        return redirect('/prefecture');
    }

    public function edit($id) {

        $prefet=Prefecture::find($id);
        return view('edit', compact('prefet'));
    }

    public function update(Request $request) {
        $request->validate([
            'prefecture_name'=> 'required'
        ]);
        $prefet = Prefecture::find($request->id);
        $prefet->name = $request->prefecture_name;

        $prefet->update();
        Session::put('message', 'The prefecture '.$request->prefecture_name.' was updated with success');
       return redirect('/prefecture');
    }

    public function delete_pref($id) {
        $prefet = Prefecture::find($id);
        $prefet->delete();
        Session::put('message', 'prefecture deleted');
       return redirect('/prefecture');
    }


 //--------------------------------------------------//------------------------------------------------
    //district function
    public function saveDistrict(Request $request) {
        try {
            $request->validate([
                'district_name' => 'required',
                'prefecture_id' => 'required'
            ]);

            $district = new District();
            $district->name = $request->input('district_name');
            $district->prefecture_id = $request->input('prefecture_id');
            $district->save();

            Session::put('message', 'The district ' . $request->district_name . ' was added with success');
        } catch (\Exception $e) {
            Session::put('error', 'Failed to add the district. Please fill all field and select a Prefecture.');
        }

        return redirect('/district');
    }

    public function showdist($id) {
        $showdist = Prefecture::find($id);
        return view('showdist')->with('showdist', $showdist);
    }

     public function editdist($id) {
            $district = District::find($id);
            $prefectures = Prefecture::orderBy('name', 'asc')->get();
            return view('editdist', compact('district', 'prefectures'));
    }

    public function updatedist(Request $request) {
        $request->validate([
            'district_name' => 'required',
            'prefecture_id' => 'required'
        ]);

        $district = District::find($request->id);
        $district->name = $request->district_name;
        $district->prefecture_id = $request->prefecture_id;

        $district->update();

        Session::put('message', 'The district ' . $request->district_name . ' was updated with success');
        return redirect('/district');
     }
     public function delete_dist($id) {
        $district = District::find($id);
        $district->delete();
        Session::put('message', 'District deleted');
       return redirect('/district');
    }
//--------------------------------------------------//------------------------------------------------
    //Borough function
    public function showBorough($id) {
        $showBorough = Borough::find($id);
        return view('showborough')->with('showBorough', $showBorough);
    }
    public function saveBorough(Request $request) {
        try {
            $borough = new Borough();
            $borough->name = $request->input('borough_name');
            $borough->district_id = $request->input('district_id');
            $borough->save();

            Session::put('message', 'The borough '.$request->borough_name.' was added with success');
            return redirect('/borough');
        } catch (\Exception $e) {
            Session::put('error', 'Failed to add borough. Please fill all field and select a District.');
            return redirect('/borough');
        }
    }

    public function editborough($id) {
        $borough = Borough::find($id);
        $districts = District::orderBy('name', 'asc')->get();
        return view('editborough', compact('borough', 'districts'));
    }

    public function updateBorough(Request $request) {
        $request->validate([
            'borough_name' => 'required',
            'district_id' => 'required'
        ]);

        $borough = Borough::find($request->id);
        $borough->name = $request->borough_name;
        $borough->district_id = $request->district_id;

        $borough->update();

        Session::put('message', 'The borough ' . $request->borough_name . ' was updated with success');
        return redirect('/borough');
     }

    public function delete_borough($id) {
        $borough = Borough::find($id);
        $borough->delete();
        Session::put('message', 'Borough deleted');
       return redirect('/borough');
    }
//--------------------------------------------------//------------------------------------------------
    //Fokontany Function
    public function showfkt($id) {
        $showfkt = Fokontany::find($id);
        return view('showfkt')->with('showfkt', $showfkt);
    }

    public function savefkt(Request $request) {
        try {
            $fkt = new Fokontany();
            $fkt->name = $request->input('fkt_name');
            $fkt->borough_id = $request->input('borough_id');
            $fkt->save();

            Session::put('message', 'The Fokontany '.$request->fkt_name.' was added with success');
            return redirect('/fonkotany');
        } catch (\Exception $e) {
            Session::put('error', 'Failed to add Fokontany. Please fill all field and select a Borough.');
            return redirect('/fonkotany');
        }
    }

    public function editfkt($id) {
        $fkt = Fokontany::find($id);
        $boroughs = Borough::orderBy('name', 'asc')->get();
        return view('editfkt', compact('fkt', 'boroughs'));
    }

    public function updateFkt(Request $request) {
        $request->validate([
            'fkt_name' => 'required',
            'borough_id' => 'required'
        ]);

        $fkt = Fokontany::find($request->id);
        $fkt->name = $request->fkt_name;
        $fkt->borough_id = $request->borough_id;

        $fkt->update();

        Session::put('message', 'The Fokontany ' . $request->fkt_name . ' was updated with success');
        return redirect('/fonkotany');
     }

     public function delete_fkt($id) {
        $fkt = Fokontany::find($id);
        $fkt->delete();
        Session::put('message', 'Fokontany deleted');
       return redirect('/fonkotany');
    }
  //------------------------------------------------------------------------------------------------

  //Citizens function
    public function addCitizen(Request $request){
    try {
        $citizens = new Citizens();
        $citizens->first_name = $request->input('firstname');
        $citizens->last_name = $request->input('name');
        $citizens->job = $request->input('job');
        $citizens->nic_place = $request->input('nic_place');
        $citizens->birth_date = $request->input('birth_date');
        $citizens->birth_place = $request->input('birth_place');
        $citizens->father = $request->input('father');
        $citizens->mother = $request->input('mother');
        $citizens->email = $request->input('email');
        $citizens->phone_num = $request->input('phone_num');
        $citizens->nic_num = $request->input('cin');
        $citizens->nic_date = $request->input('nic_date');

        $citizens->save();

        Session::put('message', 'Citizens added successfully');

        return redirect('/citizenslist');
    } catch (\Exception $e) {
        Session::put('error', 'Failed to add Citizens.');
        return view('citizens');
    }
  }
   public function updateCitizens(Request $request) {
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

    $citizens = Citizens::find($request->id);

    if (!$citizens) {
        return redirect('/citizenslist')->with('error', 'Citizens not found');
    }
    $citizens->first_name = $request->input('firstname');
    $citizens->last_name = $request->input('name');
    $citizens->job = $request->input('job');
    $citizens->nic_place = $request->input('nic_place');
    $citizens->birth_date = $request->input('birth_date');
    $citizens->father = $request->input('father');
    $citizens->email = $request->input('email');
    $citizens->mother = $request->input('mother');
    $citizens->phone_num = $request->input('phone_num');
    $citizens->nic_num = $request->input('cin');
    $citizens->nic_date = $request->input('nic_date');
    $citizens->birth_place = $request->input('birth_place');

    $citizens->save();

    Session::put('message', 'Citizens updated successfully');
    return redirect('/citizenslist');
  }
  public function editCitizens($id) {
    $citizens = Citizens::find($id);
    return view('editcitizens', compact('citizens'));
   }
   public function citizenslist() {
    $citizens = Citizens::paginate(5);
    return view('citizenslist', compact('citizens'));
   }
    public function deleteCitizens($id) {
        $citizens = Citizens::find($id);
        $citizens->delete();

        return redirect('/citizenslist')->with('message', 'Citizens deleted');
    }


//--------------------------------------------------------------------------------------------------
//Book function
 public function addBook(Request $request) {
    try {
        $book = new Book();
        $book->num = $request->input('book_num');
        $book->fokontany_id = $request->input('fkt_id');
        $book->first_head_id = $request->input('first_head_id');
        $book->second_head_id = $request->input('second_head_id');
        $book->save();

        Session::put('message', 'The Book number '.$request->book_num.' was added with success');
        return redirect('/book');
    } catch (\Exception $e) {
        Session::put('error', 'Failed to add Book. Please try again and select a name.');
        return redirect('/book');
    }
  }

     public function editBook($id) {
         $book = Book::find($id);
         $fkt = Fokontany::orderBy('name', 'asc')->get();
         $citizens = Citizens::orderBy('first_name', 'asc')->get();
        return view('editbook', compact('book', 'fkt', 'citizens'));
     }

     public function updateBook(Request $request) {
        $book = Book::find($request->id);

        if (!$book) {
            Session::put('error', 'Le livre spécifié est introuvable');
            return redirect('/book');
        }

        $book->num = $request->input('book_num');
        $book->fokontany_id = $request->input('fkt_id');
        $book->first_head_id = $request->input('first_head_id');
        $book->second_head_id = $request->input('second_head_id');
        $book->save();

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
                    Session::put('error', 'L\'ID de l\'enfant '.$validatedChildId.' n\'est pas valide');
                    return redirect('/book');
                }
            }
        } else {
            Session::put('error', 'Aucun enfant n\'a été sélectionné');
            return redirect('/book');
        }

        Session::put('message', 'Le numéro de livre '.$request->book_num.' a été mis à jour avec succès');
        return redirect('/book');
    }
 }

