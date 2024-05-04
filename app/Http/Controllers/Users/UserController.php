<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job\Application;
use App\Models\Job\JobSaved;
use Auth;
use File;


class UserController extends Controller
{
    public function profile(){

        $profile = User::find(Auth::user()->id);
        return view('users.profile', compact('profile'));
    }
    
    public function applications(){

        $applications = Application::where('user_id','=', Auth::user()->id)
        ->get();
        return view('users.applications', compact('applications'));
    }

    public function savedJobs(){

        $savedJobs = JobSaved::where('user_id','=', Auth::user()->id)
        ->get();
        return view('users.savedjobs', compact('savedJobs'));
    }

    public function editDetails(){

      $userDetails = User::find(Auth::user()->id);
        return view('users.editdetails', compact('userDetails'));
    }

    public function updateDetails(Request $request){

      Request()-> validate([
        "name" =>"required|max:40",
        "job_title" =>"required|max:40",
        "bio" =>"required",
        "facebook" =>"required|max:140",
        "twitter" =>"required|max:140",
        "linkedin" =>"required|max:140",
      ]);

      $userDetailsUpdate = User::find(Auth::user()->id);
      $userDetailsUpdate -> update([
        "name"=> $request->name,
        "job_title"=> $request->job_title,
        "bio"=> $request->bio,
        "facbook"=>$request->facebook,
        "twitter"=>$request->twitter,
        "linkedin"=>$request->linkedin,
     ] );

      if($userDetailsUpdate){
        return redirect('/users/edit-details/')->with('update', 'User Details Updated Successfully!');

    };
    }
    public function editCV(){

      return view('users.editcv');
    }

    public function updateCV(Request $request){

      $OldCV = User::find(Auth::user()->id);

      if(File::exists(public_path('asset/cvs/'.$OldCV->cv))){
        File::delete(public_path('asset/cvs/'.$OldCV->cv ));
      } else {
        //dd('File does not exists.')
      }

   
      $destinationPath= 'asset/cvs/';
      $mycv= $request->cv->getClientOriginalName();
      $request->cv->move(public_path($destinationPath),$mycv);

      $OldCV ->update([
        "cv"=> $mycv
      ]);
      return redirect('/users/profile')->with('update', 'CV Updated Successfully!');

    }
}
