@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
                    <a type="button" class="btn btn-warning" href="{{route('post')}}">Go to post</a>
                <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    @hasrole('Super-Admin')
                    <th>Action</th>
                    @endhasrole
                </thead>
                <tbody>
                <!-- to list all users existed -->

                @foreach($users as $lists)
                <tr>
                    <td>{{$loop->iteration}}</td>
                        <td>{{$lists->name}}</td>
                        <td>{{$lists->email}}</td>
                        <td>
                            @if(!empty($lists->getRoleNames()))
                                @foreach($lists->getRoleNames() as $v)
                                {{ $v }}
                                @endforeach
                            @endif
                        </td>
                        @hasrole('Admin')
                        <td><a type="button" class="btn btn-info" href="{{route('role.user',$lists->id)}}">Assign Role</a> <a type="button" class="btn btn-danger" href="{{route('delete.user',$lists->id)}}">Delete</a></td>
                        @endhasrole
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
