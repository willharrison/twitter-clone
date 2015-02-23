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

    <form action="/settings/edit" method="post">

        <input type="hidden" value="{{ csrf_token() }}" name="_token"/>

        <div class="form-group">
            <label class="col-md-4 control-label">Language</label>
            <div class="col-md-6">
                <select name="language">
                    <option value="en">English</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Country</label>
            <div class="col-md-6">
                <select name="country">
                    <option value="us">United States</option>
                    <option value="gb">United Kingdom</option>
                    <option value="ca">Canada</option>
                </select>
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