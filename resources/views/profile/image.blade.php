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

        <form action="/profile/image" enctype="multipart/form-data" method="post">

            <input type="hidden" value="{{ csrf_token() }}" name="_token"/>

            <div class="form-group">
                <input class="form-control" type="file" name="image" accept="image/*"/>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                    Upload
                </button>
            </div>

        </form>
    </div>
@endsection
