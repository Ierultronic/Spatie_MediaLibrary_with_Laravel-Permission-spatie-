@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List if News Posted') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Session::has('success_add'))
                        <div class="alert alert-success">{{Session::get('success_add')}}</div>
                    @endif
                    @if(Session::has('success_update'))
                        <div class="alert alert-success">{{Session::get('success_update')}}</div>
                    @endif
                    @if(Session::has('success_delete'))
                        <div class="alert alert-success">{{Session::get('success_delete')}}</div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                <table class="table table-bordered data-table">
                <thead>
                    <div class="d-flex p-2 bd-highlight mb-3">
                        <a href="{{ route('home') }}" class="btn btn-outline-danger btn-sm">Go Back</a>
                        @hasrole('News Editor')
                        <a href="{{ route('upload',Auth::user()->id) }}" class="btn btn-primary btn-sm">New Post</a>
                        @endhasrole
                    </div>
                <th>#</th>
                    <th>AUTHOR</th>
                    <th>TITLE</th>
                    <th>DESCRIPTION</th>
                    <th>CREATED AT</th>
                    <th>UPDATED AT</th>
                    <th>IMAGE</th>
                    @role('News Editor')
                    <th>ACTION</th>
                    @endrole
                </thead>
                <tbody>
                <!-- to list all users existed -->
                @foreach($posts as $lists)
                <tr>
                    <td>{{$loop->iteration}}</td>

                        <td>{{$lists->Author}}</td>
                        <td>{{$lists->Title}}</td>
                        <td>{{$lists->Description}}</td>
                        <td>{{$lists->created_at->toDateString()}} <br>
                            ({{Carbon\Carbon::parse($lists->created_at)->diffForHumans()}})</td>
                        <td>{{$lists->updated_at->toDateString()}} <br>
                            ({{Carbon\Carbon::parse($lists->updated_at)->diffForHumans()}})</td>
                        <td><img src="{{$lists->getFirstMediaUrl()}}"  width="120px"></td>
                        @if(auth()->user()->can('edit articles') && $lists-> Author === auth()->user()->name || auth()->user()->hasrole('Admin'))
                        <td>@hasrole('News Editor')
                            <a type="button" class="btn btn-info" href=" {{route('update.post',$lists->id)}} ">Update</a>
                            @endhasrole
                            <a type="button" class="btn btn-danger" href="{{route('delete',$lists->id)}}">Delete</a></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
