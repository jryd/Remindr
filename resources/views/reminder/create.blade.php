@extends('sbadmin')

@section('title')
Create
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create a new remindr</div>

				<div class="panel-body">

					@if ($errors->has())
				        @foreach ($errors->all() as $error)
				            <div class='bg-danger alert'>{{ $error }}</div>
				        @endforeach
				    @endif

					{!! Form::open(['url' => '/remindr']) !!}

					{!! Form::hidden('timezone', $timezone) !!}

					<div class="form-group">
						{!! Form::label('title', 'Title') !!}
						{!! Form::text('title', null, ['placeholder' => 'Title of remindr...', 'class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('date', 'Date') !!}
						{!! Form::date('date', $date, ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('time', 'Time') !!}
						{!! Form::time('time', $time->format('h:i A'), ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('description', 'Description') !!}
						{!! Form::textarea('description', null, ['placeholder' => 'Optional...', 'class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
					</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@endsection