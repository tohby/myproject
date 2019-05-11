<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        $searchKey = $request->searchKey;
        $questions = Question::search($searchKey)->paginate(15);
        return view('search', compact('questions'));
    }
}
