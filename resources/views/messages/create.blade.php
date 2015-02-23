@extends('app')

@section('content')

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

	<form action="/message/create" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
		To: <input type="text" name="to"/><br/>
        Message: <input type="text" name="message"/><br/>
		<input type="submit"/>
	</form>

@endsection