@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if(\Session::has('create'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('create')!!}</p>
                </div>
                @endif

                @if(\Session::has('delete'))
                <div class="alert alert-danger">
                    <p>{!! \Session::get('delete')!!}</p>
                </div>
                @endif

                <h5 class="card-title mb-4 d-inline">Jobs</h5>
                <a href="{{route('create.jobs')}}" class="btn btn-primary mb-4 text-center float-right">Create Jobs</a>

                <table class="table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Company</th>
                                <th scope="col">Job_Region</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($jobs as $job)
                            <tr>
                                <th scope="col">{{$job->id}}</th>
                                <th scope="col">{{$job->job_title}}</th>
                                <th scope="col">{{$job->category}}</th>
                                <th scope="col">{{$job->company}}</th>
                                <th scope="col">{{$job->job_region}}</th>
                                <td><a href="{{route('delete.jobs', $job->id)}}" class="btn btn-danger  text-center ">delete</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

@endsection