<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function sendEmail(Request $request){
        try{
        $name = $request->post('name');
        $email = $request->post('email');
        $subj = $request->post('subject');
        if($name!=null && $email!=null && $subj!=null){
            $info = array(
                'name' => $name,
            );
            Mail::send(['text' => 'mail'], $info, function ($message)
            {
                global $name, $email, $subj;
                if($subj==null)
                $subj="null";
                $message->to('allinonehub.et@gmail.com', 'All in One')->subject($subj);
                $message->from('allinonehub.et@gmail.com', $name);
            });
            return redirect()->route('home')->with(['msg','Thank you']);
            }

        else{
            return redirect()->route('home')->with(['msg','Message not submitted. Please check your inputs']);
        }
         }
        catch(Exception $e){
            return redirect()->route('home')->with(['msg','Message not submitted. Please check your inputs']);
        }
    }
}
