@extends('layouts.admin')

@section('content')

<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
            @if(\Session::has('delete'))
                <div class="alert alert-danger">
                    <p>{!! \Session::get('delete')!!}</p>
                </div>
                @endif
              <h5 class="card-title mb-4 d-inline">Job Applications</h5>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">CV</th>
                    <th scope="col">Email</th>
                    <th scope="col">View Job</th>
                    <th scope="col">Job_title</th>
                    <th scope="col">Company</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($apps as $app)
                  <tr>
                    <th scope="row">{{$app->id}}</th>
                    <td><a class="btn btn-success" href="{{asset('asset/cvs/'.$app->cv.'')}}">CV</a></td>
                    <td>{{$app->email}}</td>
                    <td><a class="btn btn-success" href="{{route('single.job',$app->id)}}">Go to Job</a></td>
                    <td>{{$app->job_title}}</td>
                     <td>{{$app->company}}</td>
                     <td><a href="{{route('delete.apps', $app->id)}}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
@endsection