<?php

namespace App\Http\Controllers;

use App\questioniers;
use App\questions;
use App\choices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionierController extends Controller
{

   public function __construct()
   {
    $this->middleware('auth');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['employee', 'admin']);

        $questionairs_all = questioniers::with(['SavedBy','Questions'])->get();

        return view('admin.questionier_list')->with('questionairs',$questionairs_all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['employee', 'admin']);

        return view('admin.questionier_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['employee', 'admin']);

        $Questionair = new questioniers;

        $Questionair->user_id = Auth::id();
        $Questionair->name = $request->name;
        $Questionair->duration = $request->duration;
        $Questionair->resumeable = $request->resumeable;
        $Questionair->published = $request->published;

        $Questionair->save();

        return redirect('/questioniers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\questioniers  $questioniers
     * @return \Illuminate\Http\Response
     */
    public function show(questioniers $questioniers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\questioniers  $questioniers
     * @return \Illuminate\Http\Response
     */
    public function edit(questioniers $questioniers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\questioniers  $questioniers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, questioniers $questioniers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\questioniers  $questioniers
     * @return \Illuminate\Http\Response
     */
    public function destroy(questioniers $questioniers)
    {
        //
    }

    //Methods to create a new question in existing questionair

    public function create_question(Request $request){

        Auth::user()->authorizeRoles(['employee', 'admin']);

        $questions = questions::with('choices')->where('questionier_id',$request->id)->get();
        $data['questions'] = $questions;
        $data['questionair_id'] = $request->id;

        return view("admin.question_create")->with('data',$data);
    }

    public function store_question(Request $request){

        Auth::user()->authorizeRoles(['employee', 'admin']);
        
        //clearing records if exists
        $question_ids = questions::where('questionier_id',$request->questionair_id)->pluck('id');
        questions::destroy($question_ids);

        if($request->question){
            foreach ($request->question as $key => $value) {

                $question_db = new questions;

                $question_db->user_id = Auth::id();
                $question_db->questionier_id = $request->questionair_id;
                $question_db->type = $request->type[$key];
                $question_db->question = $value;
                $question_db->answer = $request->answer[$key];

                $question_db->save();
                $question_id = $question_db->id;

                $choices = str_replace(' ', '_', $value);
                $correct_choices = $choices.'_correct';
                
                if($request->type[$key] != 'text'){
                    foreach ($request->$choices as $key => $choice) {
                       if($choice){

                        $choice_db = new choices;

                        $choice_db->user_id = Auth::id();
                        $choice_db->question_id = $question_id;
                        $choice_db->choice = $choice;
                        if($request->$correct_choices){
                            if(in_array($choice, $request->$correct_choices)){

                                $choice_db->correct = true;

                            }else{
                                $choice_db->correct = false;
                            }
                        }

                        $choice_db->save();

                    }   
                }

            }


        }
    }

        //dd($request);

    return redirect('/questioniers');
}
}
