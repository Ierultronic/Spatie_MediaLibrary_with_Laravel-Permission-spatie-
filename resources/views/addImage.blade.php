@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New News') }}</div>
                    <div class="d-flex p-2 bd-highlight mb-3">
                        <a href="{{ route('post') }}" class="btn btn-outline-danger btn-sm">Go Back</a>
                    </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('store',Auth::user()->id)}}">
                        @csrf

                        <div class="row mb-3">
                            <input type="hidden" id="name" name="name" value="{{Auth::user()->name}}">
                            <div class="row mb-3">
                                <label for="Title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input id="Title" type="text" class="form-control @error('Title') is-invalid @enderror" name="Title" required autocomplete="Title" autofocus>

                                    @error('Title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="desc" type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" required autocomplete="desc" autofocus>

                                    @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <label for="img" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="img" type="file" class="form-control" name="img">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
