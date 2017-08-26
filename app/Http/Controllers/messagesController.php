<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class messagesController extends Controller
{

    public function userProfile($userName){
        $user = User::where('name',$userName)->count();
        $userData = User::where('name',$userName)->first();
        $user_name = $userData->name;
        $user_image = $userData->photo;
        $userId = $userData->id;
        if($user_image == null){
            $user_image = "https://graph.facebook.com/2014093932159244/picture?type=large";
        }else{
            $user_image = URL::to($user_image);
        }
//        dd($user_name);
        if($user <= 0){
            abort(404);
        }else{
            return view('message',['user_name'=>$user_name , 'user_image' => $user_image,'userId' => $userId]);
        }

    }

    public function postMessage($userName,Request $request){
        $user = User::where('name',$userName)->count();
        $userData = User::where('name',$userName)->first();
        $userId = $userData->id;
        if($user <= 0){
            abort(404);
        }else{

            // return redirect('home/dashboard');
//            dd(Auth::user());
            if(Auth::user() != null && Auth::user()->name == $userName){
                Session::flash('message', 'áÇ íãßäß ÇÑÓÇá ÑÓÇáÉ áäÝÓß');
                Session::flash('alert-class', 'alert-danger');
                return redirect('home');
            }else{
                Message::create([
                    'user_id' => $userId,
                    'content' => $request->input('Text')
                ]);
                return redirect('done');
            }

        }
    }

    public function done(){
        return view('done');
    }

    public function deleteMessage($id){
        // check if message exist and belongs to current user
//        Session::flash('message', 'This is a message!');
//        Session::flash('alert-class', 'alert-danger');
        $message = Message::where('id',$id)->first();
        if($message->user_id == Auth::user()->id){
            Message::where('id',$id)->delete();
            Session::flash('message', 'Êã ÍÐÝ ÇáÑÓÇáÉ ÈäÌÇÍ');
            Session::flash('alert-class', 'alert-success');
            return redirect('home');
        }else{
            Session::flash('message', 'áíÓ áÏíß ÕáÇÍíÇÊ áÍÐÝ åÐå ÇáÑÓÇáÉ');
            Session::flash('alert-class', 'alert-danger');
        }
    }

    public function profileImageUpload(Request $request){
        // upload new image
        $file = $request->file('image');
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
        $newImagePath = 'uploads/'.$file->getClientOriginalName();

        $oldImagePath = Auth::user()->photo;
        // delete old image
        if($oldImagePath != null){
            try{
                unlink($oldImagePath);
            }catch (\Exception $e){
                return $e->getMessage();
            }
        }
        // update user image
        Auth::user()->photo = $newImagePath;
        Auth::user()->save();
        return redirect('home');

    }

}
