@extends('app')

@section('content')

    @if (isset($message))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/profile/edit" method="post">

        <input type="hidden" value="{{ csrf_token() }}" name="_token"/>

        <div class="form-group">
            <label class="col-md-4 control-label">Display Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="display_name" value="{{ $profile->display_name }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Tagline</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="tagline" value="{{ $profile->tagline }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Location</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="location" value="{{ $profile->location }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Website</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="website" value="{{ $profile->website }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                    Save
                </button>
            </div>
        </div>

    </form>
@endsection