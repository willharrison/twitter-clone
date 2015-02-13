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

    <div class="form-group">
        <label class="col-md-4 control-label">E-Mail Address</label>
        <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="{{ $request->user()->email }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Full Name</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="full_name" value="{{ $request->user()->settings->full_name }}">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                Save
            </button>
        </div>
    </div>

@endsection