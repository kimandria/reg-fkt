<?php

use App\Models\Book;
use App\Models\Citizens;
use App\Models\Movement;
use App\Models\Child;

if (!function_exists('get_fokontany_details')) {
    function get_fokontany_details($fokontany)
    {
        $id = $fokontany->id;

        // List citizens in this fokontany
        // 1. Get all books that have fokontany_id = $id
        $books = Book::where('fokontany_id', $id)->get();
        // 2. Get all children that have book_id = $book->id
        $children = [];
        foreach ($books as $book) {
            // $children = array_merge($children, Child::where('book_id', $book->id)->get()->toArray());
            // 2.1. Get the citizen_id of the children
            $iChildren = Child::where('book_id', $book->id)->get();
            foreach ($iChildren as $iChild) {
                $children = array_merge($children, Citizens::where('id', $iChild->citizen_id)->get()->toArray());
            }
        }
        // 3. Find the father (his id is in the book as first_head_id)
        $fathers = [];
        foreach ($books as $book) {
            $fathers = array_merge($fathers, Citizens::where('id', $book->first_head_id)->get()->toArray());
        }
        // 4. Find the mother (her id is in the book as second_head_id)
        $mothers = [];
        foreach ($books as $book) {
            $mothers = array_merge($mothers, Citizens::where('id', $book->second_head_id)->get()->toArray());
        }
        // 5. Citizens = children + fathers + mothers
        $citizens = array_merge($children, $fathers, $mothers);

        $fokontany->num_citizens = count($citizens);
        $fokontany->citizens = $citizens;
        $fokontany->books = $books;

        // List movements in this fokontany
        // 1. Get all movements that have from_fkt_id = $id
        $departures = Movement::where([
            ['from_fkt_id', '=', $id],
            // ['pending', '=', false],
        ])->get();
        // 2. Get all movements that ahve to_fkt_id = $id
        $arrivals = Movement::where([
            ['to_fkt_id', '=', $id],
            // ['pending', '=', false],
        ])->get();

        $fokontany->num_arrivals = count($arrivals);
        $fokontany->num_departures = count($departures);
        $fokontany->arrivals = $arrivals;
        $fokontany->departures = $departures;
        // Get the number of confirmed movements
        $fokontany->num_confirmed_arrivals = count(Movement::where([
            ['to_fkt_id', '=', $id],
            ['pending', '=', false],
        ])->get());
        $fokontany->num_confirmed_departures = count(Movement::where([
            ['from_fkt_id', '=', $id],
            ['pending', '=', false],
        ])->get());

        return $fokontany;
    }
}

