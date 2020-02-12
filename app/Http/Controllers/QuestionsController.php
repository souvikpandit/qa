<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Question::with('user) means this will load user function from Question model
         * That is because in user function we use eloquent relationship
         * if we not use with method then it will cause n+1 query problem
         * because eloquent relationship loads lasily
         * thats why we use with method to load when Question Model is called
         * this is called eager loding
         */
        $questions = Question::with('user')->latest()->paginate(10);
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question;
        return view('questions.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Here we use a saparate file to do the validation rule,
     * So we create a request by the command-
     * php artisan make:request AskQuestionRequest
     * it will create a folder named Requests inside app/Http/Controllers
     * Inside the folder all the requests are stored
     * And we import the class above
     */
    /**
     * In this store method the request object first call the user model
     * In that model there exists a questions method
     * Then we use create() 
     * This will create an instance of question model,and store the requested inputs in the question table
     * Here we use all(),but we can also do this by using only() Ex-only('title','body') 
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->all());
        return redirect('/questions')->with('success','You have successfully ask the Question');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('questions.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $question->update($request->only('title','body'));
        return redirect('/questions')->with('success','Your Question has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('/questions')->with('success','Your Question has been Deleted');
    }
}
