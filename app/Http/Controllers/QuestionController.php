<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::orderBy('created_at', 'desc')->simplePaginate(12);
        return view('home')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'question'  => 'required'
        ]);
        $random = Str::random(6);
        $title = $request->input('title');
        $slug = Str::slug($title, '-').'-'.$random;
        $question = Question::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'question' => $request->input('question'),
            'user_id' => Auth::id()
        ]);
        return redirect('question/'.$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
        $question = Question::find($question->id);
        return view('questions/show', compact('question'));
    }

    public function myQuestions(){
        // $questions = Question::orderBy('created_at', 'desc')->simplePaginate(12);
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('questions/myquestions')->with('questions', $user->questions);
    }

    public function unsolved(){
        $questions = Question::whereNull('best_reply')
               ->orderBy('created_at', 'desc')
               ->take(10)
               ->get();
        return view('questions/unsolved')->with('questions', $questions);
    }

    public function solved(){
        $questions = Question::whereNotNull('best_reply')
               ->orderBy('created_at', 'desc')
               ->take(10)
               ->get();
        return view('questions/unsolved')->with('questions', $questions);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'question' => 'required',
        ]);
        $question = Question::find($question->id);
        $question->title = $request->title;
        $question->question = $request->question;
        $question->save();
        return redirect('/question/'.$question->slug)->with('success', 'Your Question has been updated');
    }

    public function trash(){
        $user = Auth::user()->id;
        $questions = Question::onlyTrashed()->where('user_id', $user)->simplePaginate(12);
        return view('questions/trash', compact('questions'));
    }

    public function restore(Question $question){
        $question= Question::withTrashed()->find($question->id);
        $question->restore();   
        return back()->with('succes', 'Your question has been restored and can now be viewed publicly');
        // return $question;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
        $question = Question::find($question->id);
        $question->delete();
        return redirect('/question')->with('success', 'Your question has been deleted');
    }
}
