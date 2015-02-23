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

    <form action="/profile/image" enctype="multipart/form-data" method="post">

        <input type="hidden" value="{{ csrf_token() }}" name="_token"/>

         <input type="file" name="image" accept="image/*"/>

        <input type="submit" value="Upload">

    </form>
@endsection
