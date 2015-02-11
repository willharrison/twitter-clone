@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<form action="post/create" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
					<input type="text" name="post"/>
					<input type="submit"/>
				</form>
				<div class="panel-body">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
