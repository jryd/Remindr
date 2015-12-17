@extends('sbadmin')

@section('title')
Scheduled Remindrs
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1><i class="fa fa-time"></i> Scheduled Remindrs</h1>

			<div class="table-responsive">
		        <table class="table table-bordered table-striped">
		            <thead>
		                <tr>
		                	<th>Name</th>
		                    <th>Title</th>
		                    <th>Remindr Date</th>
		                    <th></th>
		                </tr>
		            </thead>
		 
		            <tbody>
		                @foreach ($reminders as $reminder)
		                <tr>
		                	<td>{{ $reminder->user->firstname }} {{ $reminder->user->lastname }}</td>
		                    <td>{{ $reminder->title }}</td>
		                    <td>{{ (new Carbon\Carbon($reminder->utcReminderDate))->format('F d, Y h:ia') }}</td>
		                    <td>
		                        <a href="{{ url('admin') }}/{{ $reminder->id }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>

		        </table>
    		</div>
    		{!! $reminders->render() !!}
		</div>
	</div>
</div>
@endsection