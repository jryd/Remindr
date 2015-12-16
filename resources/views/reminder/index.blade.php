@extends('sbadmin')

@section('title')
My Remindrs
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1><i class="fa fa-time"></i> My Remindrs</h1>

			<div class="table-responsive">
		        <table class="table table-bordered table-striped">
		            <thead>
		                <tr>
		                    <th>Title</th>
		                    <th>Remindr Date</th>
		                    <th></th>
		                </tr>
		            </thead>
		 
		            <tbody>
		                @foreach ($reminders as $reminder)
		                <tr>
		                    <td>{{ $reminder->title }}</td>
		                    <td>{{ (new Carbon\Carbon($reminder->userReminderDate))->format('F d, Y h:ia') }}</td>
		                    <td>
		                        <a href="{{ url('remindr') }}/{{ $reminder->id }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>

		        </table>
    		</div>
		</div>
	</div>
</div>
@endsection