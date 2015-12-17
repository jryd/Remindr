<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Reminder;

use Request as ClientRequest;
use Mail;
use Validator;
use Input;
use Redirect;
use Auth;

use GuzzleHttp\Client;

class RemindController extends Controller
{
    //Import auth middleware to ensure user is logged in
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reminders = Reminder::where('memberid', '=', Auth::user()->id)->get();

        return view('reminder.index', compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$url = "http://freegeoip.net/json/202.21.128.254";
        $client = new Client();
        $response = $client->request('GET', $url);
        $geoip = json_decode($response->getBody());
        $timezone = $geoip->time_zone;*/

        //Get the user's timezone from the DB
        $timezone = Auth::user()->timezone;

        //If no value is stored in the DB, then set it to UTC
        if ($timezone == "" || $timezone == null)
        {
            $timezone = "UTC";
        }

        //Set time and date variables to local time and date for user
        $time = \Carbon\Carbon::now()->setTimeZone($timezone);
        $date = \Carbon\Carbon::now()->setTimeZone($timezone)->toDateString();

        return view('reminder.create', compact('time', 'date', 'timezone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => "required|between:2,30",
            'date' => "required|date",
            'time' => "required",
            'timezone' => "required|timezone",
        ], [
            'title.required' => 'You need to provide a title!',
            'date.required' => 'You need to provide a date!',
            'time.required' => 'You need to provide a time!',
            'timezone.required' => "The timezone is a required field - please don't remove it...",
            'title.between' => 'The title must be between :min - :max characters long.',
            'date.date' => 'The date needs to be formatted as a date dd/mm/yyyy',
            'timezone.timezone' => 'The timezone was already formatted to your timezone, the one you have changed it to is not a supported timezone...',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }


        $userDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->time, $request->timezone);
        $utcDateTime = clone $userDateTime;
        $utcDateTime->setTimeZone('UTC');

        $currentDateTime = \Carbon\Carbon::now()->format('Y-m-d H:i');

        if ($utcDateTime < $currentDateTime)
        {
            $validator->getMessageBag()->add('oldate', 'The date and time provided is in the past, please provide a future date and time.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $data = array('title' => $request->title, 'date' => $userDateTime);

        $reminder = new Reminder;

        $reminder->memberid = Auth::user()->id;
        $reminder->title = $request->title;
        $reminder->userReminderDate = $userDateTime;
        $reminder->utcReminderDate = $utcDateTime;
        $reminder->description = $request->description;

        $reminder->save();

        flash()->success('Your reminder was successfully set.');

        return redirect('/remindr');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reminder = Reminder::findOrFail($id);

        return view('reminder.show', compact('reminder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reminder = Reminder::findOrFail($id);

        return view('reminder.edit', compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reminder = Reminder::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => "required|between:2,30",
            'date' => "required|date",
            'time' => "required",
            'timezone' => "required|timezone",
        ], [
            'title.required' => 'You need to provide a title!',
            'date.required' => 'You need to provide a date!',
            'time.required' => 'You need to provide a time!',
            'timezone.required' => "The timezone is a required field - please don't remove it...",
            'title.between' => 'The title must be between :min - :max characters long.',
            'date.date' => 'The date needs to be formatted as a date dd/mm/yyyy',
            'timezone.timezone' => 'The timezone was already formatted to your timezone, the one you have changed it to is not a supported timezone...',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }


        $userDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->time, $request->timezone);
        $utcDateTime = clone $userDateTime;
        $utcDateTime->setTimeZone('UTC');

        $currentDateTime = \Carbon\Carbon::now()->format('Y-m-d H:i');

        if ($utcDateTime < $currentDateTime)
        {
            $validator->getMessageBag()->add('oldate', 'The date and time provided is in the past, please provide a future date and time.');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $reminder->title = $request->title;
        $reminder->userReminderDate = $userDateTime;
        $reminder->utcReminderDate = $utcDateTime;
        $reminder->description = $request->description;

        $reminder->save();

        flash()->success('Your reminder was successfully updated.');

        return redirect('/remindr');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reminder::destroy($id);

        flash()->success('Your remindr was successfully deleted.');
        return redirect('/remindr');
    }
}
