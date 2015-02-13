@extends('app')

@section('content')

	<form action="post/create" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
		<input type="text" name="post"/>
		<input type="submit"/>
	</form>

@endsection
