@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Data') }}</div>
                <div class="d-flex p-2 bd-highlight mb-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger btn-sm">Go Back</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route("update.user",$Edit->id)}}">
                        @csrf
                        <input type="hidden" id="name" name="name" value="{{$Edit->name}}">
                        <input type="hidden" id="email" name="email" value="{{$Edit->email}}">
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Assign Role') }}</label>
                            <div class="col-md-6">
                                <select class="form-select" name="role">
                                    <option value="{{ $Edit->id }}">@if(!empty($Edit->getRoleNames()))
                                        @foreach($Edit->getRoleNames() as $v)
                                        {{ $v }}
                                        @endforeach
                                    @endif</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
