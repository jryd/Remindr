@extends('sbadmin')

@section('title')
Home
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					@if (Auth::guest())
					You are not logged in!
					@else
					You are logged in!
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection