@extends('sbadmin')

@section('title')
{{ $reminder->title }}
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $reminder->user->firstname }} {{ $reminder->user->lastname }}'s Remindr</div>

				<div class="panel-body">

					@if ($errors->has())
				        @foreach ($errors->all() as $error)
				            <div class='bg-danger alert'>{{ $error }}</div>
				        @endforeach
				    @endif

					<p><strong>Title:</strong> {{ $reminder->title }}</p>
					<p><strong>Remindr Date:</strong> {{ (new Carbon\Carbon($reminder->userReminderDate))->format('F d, Y h:ia') }}</p>
					<p><strong>Description:</strong></p>
					<p style="word-break: break-word">
						@if ($reminder->description == "" || $reminder->description == null)
						This remindr likes to keep an air of mystery about it
						@else
						{!! nl2br(e($reminder->description)) !!}
						@endif
					</p>
					<a href="{{ url('admin/' . $reminder->id . '/edit') }}" class="btn btn-primary pull-left" style="margin-right: 3px;">Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
				</div>
			</div>

			<div class="modal fade" id="deleteModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Delete Remindr</h4>
						</div>
						<div class="modal-body">
							{!! Form::open(['url' => 'remindr/' . $reminder->id, 'method' => 'DELETE']) !!}
							<p>Are you really sure you want to delete this?</p>
							<p>Deleteing a remindr is not reversible.</p>
		                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                    {!! Form::close() !!}
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection