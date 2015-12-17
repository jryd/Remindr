<?php

namespace App\Handlers\Events;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Request;
use GuzzleHttp\Client;

class AuthLoginEventHandler
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(User $user)
    {
        $member = User::find($user->id);

        if ($member != null)
        {
            $url = "http://freegeoip.net/json/" . Request::getClientIp();
            $client = new Client();
            $response = $client->request('GET', $url);
            $geoip = json_decode($response->getBody());
            $timezone = $geoip->time_zone;

            $member->timezone = $timezone;
            $member->save();
        }
    }
}
