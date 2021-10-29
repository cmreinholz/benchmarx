<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user()->id;

        $noresponseqs = DB::select(DB::raw("SELECT * FROM questions q
	
        WHERE NOT EXISTS (SELECT * FROM responses r
        WHERE r.question_id = q.id  AND user_id= :userid) 
        AND active=1
        AND dependent_id is null"), array(
            'userid' => $user,
        ));

        if (isset($noresponseqs[0]->responses)){
           
            $noresponseqs[0]->responsesArray=json_decode($noresponseqs[0]->responses, true);
        }


        //dd($noresponseqs);
        return view('dashboard', compact('noresponseqs'));
    }

    public function response(Request $request)
    {   //dd($request);
        $now = Carbon::now();
        if ($request->type == 'currency') {
            $validatedData = $request->validate([
                'currency' => 'required|numeric',
                
            ]);
            
            
           // dd($user);
            $response = new Response;
            
                $response->question_id = $request->question_id;
                $response->user_id=Auth::user()->id;
                $response->year=$now->year;
                $response->response=$request->currency;
        
                $response->save();  
if ($response->question_id == 13){
    $revenue=Response::select('response')->where('question_id', '=', 13)
    ->where('user_id', '=', Auth::user()->id)
    ->where('year', '=', $now->year)
    ->first();
dd($revenue);
$profitability=($request->currency/$revenue->response);
$response = new Response;
            
                $response->question_id = 17;
                $response->user_id=Auth::user()->id;
                $response->year=$now->year;
                $response->response=$profitability;
        
                $response->save();  
}

                
                return view('dashboard');  

            
        }

        if ($request->type == 'checkbox') {
            $response = new Response;
            $validatedData = $request->validate([
                'checkbox' => 'required',
                
            ]);
            $checkbox=json_encode($request->checkbox);
            
            $response->question_id = $request->question_id;
            $response->user_id=Auth::user()->id;
            $response->year=$now->year;
            $response->response=$checkbox;
    
            $response->save();  
            
            return view('dashboard'); 
        }

        if ($request->type == 'radio') {
            $response = new Response;
            $validatedData = $request->validate([
                'radio' => 'required',
                
            ]);
            
            
            $response->question_id = $request->question_id;
            $response->user_id=Auth::user()->id;
            $response->year=$now->year;
            $response->response=$request->radio;
    
            $response->save();  
            
            return view('dashboard'); 
        }

        if ($request->type == 'text') {
            $response = new Response;
            $validatedData = $request->validate([
                'text' => 'required',
                
            ]);
            
            
            $response->question_id = $request->question_id;
            $response->user_id=Auth::user()->id;
            $response->year=$now->year;
            $response->response=$request->text;
    
            $response->save();  
            
            return view('dashboard'); 
        }

        if ($request->type == 'textarea') {
            $response = new Response;
            $validatedData = $request->validate([
                'textarea' => 'required',
                
            ]);
            
            
            $response->question_id = $request->question_id;
            $response->user_id=Auth::user()->id;
            $response->year=$now->year;
            $response->response=$request->textarea;
    
            $response->save();  
            
            return view('dashboard'); 
        }
    }
}
