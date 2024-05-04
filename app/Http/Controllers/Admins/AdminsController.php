<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Job\Job;
use App\Models\Category\Category;
use App\Models\Job\Application;
use Illuminate\Support\Facades\Hash;
use File;

class AdminsController extends Controller
{


    public function viewLogin()
    {

        return view("admins.view-login");
    }

    public function checkLogin(Request $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index()
    {

        $jobs = Job::select()->count();
        $categories = Category::select()->count();
        $admins = Admin::select()->count();
        $applications = Application::select()->count();

        return view("admins.index", compact('jobs', 'categories', 'admins', 'applications'));
    }

    public function admins()
    {

        $admins = Admin::all();
        return view("admins.all-admins", compact('admins'));
    }


    public function createAdmins()
    {

        return view("admins.create-admins");
    }

    public function storeAdmins(Request $request)
    {

        Request()->validate([
            "name" => "required|max:40",
            "email" => "required|max:40",
            "password" => "required",

        ]);

        $createAdmins = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($createAdmins) {
            return redirect('admin/all-admins/')->with('create', 'Admin Created Successfully!');
        };
    }

    public function displayCategories()
    {

        $categories = Category::all();

        return view("admins.display-categories", compact('categories'));
    }

    public function createCategories()
    {
        return view("admins.create-categories");
    }

    public function storeCategories(Request $request)
    {

        Request()->validate([
            "name" => "required|max:40",


        ]);

        $createCategory = Category::create([
            'name' => $request->name,

        ]);

        if ($createCategory) {
            return redirect('admin/display-categories')->with('create', 'Category Created Successfully!');
        };
    }

    public function editCategories($id)
    {

        $category = Category::find($id);
        return view("admins.edit-categories", compact('category'));
    }

    public function updateCategories(Request $request, $id)
    {

        Request()->validate([
            "name" => "required|max:40",

        ]);

        $categoryUpdate = Category::find($id);
        $categoryUpdate->update([
            "name" => $request->name,

        ]);

        if ($categoryUpdate) {
            return redirect('/admin/display-categories/')->with('update', 'Category Updated Successfully!');
        };
    }

    public function deleteCategories($id)
    {

        $deletecategory = Category::find($id);
        $deletecategory->delete();

        if ($deletecategory) {
            return redirect('/admin/display-categories/')->with('delete', 'Category Deleted Successfully!');
        };
    }

    //jobs


    public function allJobs()
    {

        $jobs = Job::all();

        return view("admins.all-jobs", compact('jobs'));
    }


    public function createJobs()
    {
        $categories = Category::all();
        return view("admins.create-jobs", compact('categories'));
    }

    public function storeJobs(Request $request)
    {

        Request()->validate([
            "job_title" => "required| max:40",
            'job_region' =>"required| max:40",
            "company" =>"required",
            'job_type' =>"required",
            'vacancy' =>"required",
            'experience' =>"required",
            'salary' =>"required",
            'Gender' =>"required",
            "application_deadline" =>"required",
            'job_description' =>"required",
            'responsibilities' =>"required",
             'education' =>"required",
            'other_benafits' =>"required",
            'category' => "required",
            'image' =>"image",


        ]);

        $destinationPath= 'asset/images/';
        $myimage= $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath),$myimage);

        $createJobs = Job::create([
            'job_title' => $request->job_title,
            'job_region' => $request->job_region,
            'company' => $request->company,
            'job_type' => $request->job_type,
            'vacancy' => $request->vacancy,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'Gender' => $request->Gender,
            'application_deadline' => $request->application_deadline,
            'job_description' => $request->job_description,
            'responsibilities' => $request->responsibilities,
            'education' => $request->education,
            'other_benafits' => $request->other_benafits,
            'category' => $request->category,
            'image' => $myimage,
            

        ]);

        if ($createJobs) {
            return redirect('admin/display-jobs/')->with('create', 'Jobs Created Successfully!');
        };
    }

    public function deleteJobs($id)
    {

        $deletejob = Job::find($id);

        if(File::exists(public_path('asset/images/'.$deletejob->image))){
            File::delete(public_path('asset/images/'.$deletejob->image));
          } else {
            //dd('File does not exists.')
          }

          $deletejob -> delete();

        if ($deletejob) {
            return redirect('/admin/display-jobs/')->with('delete', 'Jobs Deleted Successfully!');
        };
    }

    public function displayApplications()
    {

        $apps = Application::all();

        return view("admins.all-applications", compact('apps'));
    }

    public function deleteApps($id)
    {

        $deleteapp = Application::find($id);

       

          $deleteapp -> delete();

        if ($deleteapp) {
            return redirect('/admin/display-apps/')->with('delete', 'Application Deleted Successfully!');
        };
    }
}

    