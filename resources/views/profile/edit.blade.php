@extends('app')

@section('content')

    <div class="col-xs-offset-3 col-xs-6" style="padding: 50px">

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
                <label class="control-label">Display Name</label>
                    <input type="text" class="form-control" name="display_name" value="{{ $profile->display_name }}">
            </div>

            <div class="form-group">
                <label class="control-label">Tagline</label>
                    <input type="text" class="form-control" name="tagline" value="{{ $profile->tagline }}">
            </div>

            <div class="form-group">
                <label class="control-label">Location</label>
                    <input type="text" class="form-control" name="location" value="{{ $profile->location }}">
            </div>

            <div class="form-group">
                <label class="control-label">Website</label>
                    <input type="text" class="form-control" name="website" value="{{ $profile->website }}">
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                        Save
                    </button>
            </div>

        </form>
    </div>

@endsection