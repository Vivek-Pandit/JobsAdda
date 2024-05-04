<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Job\Job;

class CategoryController extends Controller
{
    

    public function singleCategory($name){
        $jobs= Job::where('category',$name )
        ->take(5)
        ->orderby('created_at', 'desc')
        ->get();
        


        return view('categories.single', compact('jobs', 'name'));
    }
}
