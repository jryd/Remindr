@extends('sbadmin')

@section('title')
{{ $reminder->title }}
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Your Remindr</div>
				<div class="panel-body">

					@if ($errors->has())
				        @foreach ($errors->all() as $error)
				            <div class='bg-danger alert'>{{ $error }}</div>
				        @endforeach
				    @endif

					{!! Form::model($reminder, ['role' => 'form', 'url' => '/remindr/' . $reminder->id, 'method' => 'PUT']) !!}

					{!! Form::hidden('timezone', Auth::user()->timezone) !!}

					<div class="form-group">
						{!! Form::label('title', 'Title') !!}
						{!! Form::text('title', null, ['placeholder' => 'Title of remindr...', 'class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('date', 'Date') !!}
						{!! Form::date('date', (new Carbon\Carbon($reminder->userReminderDate))->format('Y-m-d'), ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('time', 'Time') !!}
						{!! Form::time('time', (new Carbon\Carbon($reminder->userReminderDate))->format('H:i'), ['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('description', 'Description') !!}
						{!! Form::textarea('description', null, ['placeholder' => 'Optional...', 'class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
					</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@endsection