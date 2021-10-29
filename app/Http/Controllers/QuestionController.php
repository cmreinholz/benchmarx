<?php

namespace App\Http\Controllers;

use App\Question;
use App\Response;
use Illuminate\Http\Request;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createQuestion');//
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //dd($question);
        // get responses by region, revenue, profitability, year - for multiple choice?
        //revenue

        //get all the responses. Then loop through and get the revenue for each? Seems processor-heavy
        if ($question->type == 'radio') {
            //get all responses
            
            $responses = Question::select('responses')->where('id', '=', $question->id)->get();
            $json = json_decode($responses[0]->responses, true);
            $allrevenue = [];
            foreach ($json as $key => $value) {
                $users = Response::select('user_id')->where('question_id', '=', $question->id)
                ->where('year', '=', now()->year)
                ->where('response', '=', $value)
                ->get();
                $lessthan1k = 0;
            $upto250K = 0;
            $upto500K = 0;
            $upto1mil = 0;
            $upto5mil = 0;
            $upto25mil = 0;
            $morethan25mil = 0;
            $unprofitable = 0;
            $lessthan10percent = 0;
            $lessthan20percent = 0;
            $lessthan30percent = 0;
            $lessthan40percent = 0;
            $lessthan50percent = 0;
            $lessthan60percent = 0;
            $lessthan70percent = 0;
            $lessthan80percent = 0;
            $morethan80percent = 0;

                //dd($users);
                foreach ($users as $user) {
                    $revenue = Response::select('response')
                    ->where('question_id', '=', '13')
                    ->where('year', '=', now()->year)
                    ->where('user_id', '=', $user->user_id)
                    ->get();

                $profitability = Response::select('response')
                ->where('question_id', '=', '17')
                ->where('year', '=', now()->year)
                ->where('user_id', '=', $user->user_id)
                ->get();

                //unprofitable, .01 to 10, 10.01-20, 20.01-30, etc. up to 80?

                    if ($profitability[0]->response<= 0){
                        $unprofitable++;
                    }
                    if ($profitability[0]->response>0 AND $profitability[0]->response < 10){
                        $lessthan10percent++;
                    }

                    if ($profitability[0]->response>=10 AND $profitability[0]->response < 20){
                        $lessthan20percent++;
                    }
                    if ($profitability[0]->response>=20 AND $profitability[0]->response < 30){
                        $lessthan30percent++;
                    }
                    if ($profitability[0]->response>=30 AND $profitability[0]->response < 40){
                        $lessthan40percent++;
                    }
                    if ($profitability[0]->response>=40 AND $profitability[0]->response < 50){
                        $lessthan50percent++;
                    }
                    if ($profitability[0]->response>=50 AND $profitability[0]->response < 60){
                        $lessthan60percent++;
                    }
                    if ($profitability[0]->response>=60 AND $profitability[0]->response < 70){
                        $lessthan70percent++;
                    }
                    if ($profitability[0]->response>=70 AND $profitability[0]->response < 80){
                        $lessthan80percent++;
                    }
                    if ($profitability[0]->response>=80 AND $profitability[0]->response < 100){
                        $morethan80percent++;
                    }
                

                    if ($revenue[0]->response < 100000) {
                        $lessthan1k = $lessthan1k + 1;
                    }
                    if ($revenue[0]->response > 99999 and $revenue[0]->response < 250000) {
                        $upto250K = $upto250K + 1;
                    }
                    if ($revenue[0]->response > 249999 and $revenue[0]->response < 500000) {
                        $upto500K = $upto500K + 1;
                    }
                    if ($revenue[0]->response > 499999 and $revenue[0]->response < 1000000) {
                        $upto1mil = $upto1mil + 1;
                    }
                    if ($revenue[0]->response > 999999 and $revenue[0]->response < 5000000) {
                        $upto5mil = $upto5mil + 1;
                    }
                    if ($revenue[0]->response > 4999999 and $revenue[0]->response < 25000000) {
                        $upto25mil = $upto25mil + 1;
                    }
                    if ($revenue[0]->response > 24999999) {
                        $morethan25mil = $morethan25mil + 1;
                    }

                    $rev[$value] = [
                        'Less Than 100K' => $lessthan1k,
                        '100K to 2500K' => $upto250K,
                        '250K to 500 million' => $upto500K,
                        '500K to 1 million' => $upto1mil,
                        '1 Million to 5 million' => $upto5mil,
                        '5 Million to 25 million' => $upto25mil,
                        'More than 25 million' => $morethan25mil
                    ];

                    $prof[$value] = [
                        'Unprofitable' => $unprofitable,
                        '0 to 9.99%' => $lessthan10percent,
                        '10 to 19.99%' => $lessthan20percent,
                        '20 to 29.99%' => $lessthan30percent,
                        '30 to 39.99%' => $lessthan40percent,
                        '40 to 49.99%' => $lessthan50percent,
                        '50 to 59.99%' => $lessthan60percent,
                        '60 to 69.99%' => $lessthan70percent,
                        '70 to 79.99%' => $lessthan80percent,
                        '80 to 99.99%' => $morethan80percent,
                    ];
                }
            }
            
        }
        dd($prof);
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
    }
}
