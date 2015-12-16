<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Reminder;
use App\SentReminders;
use Mail;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all current reminders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reminders = Reminder::where('utcReminderDate' , '<=', \Carbon\Carbon::now()->format('Y-m-d H:i'))->get();

        foreach($reminders as $reminder)
        {
            Mail::send('emails.test', [], function($message) use($reminder) {
                $message->to($reminder->user->email, $reminder->user->firstname . ' ' . $reminder->user->lastname);
                $message->subject('Friendly Remindr');
            });

            $moveReminder = new SentReminders;

            $moveReminder->id = $reminder->id;
            $moveReminder->memberid = $reminder->memberid;
            $moveReminder->title = $reminder->title;
            $moveReminder->userReminderDate = $reminder->userReminderDate;
            $moveReminder->utcReminderDate = $reminder->utcReminderDate;
            $moveReminder->description = $reminder->description;

            $moveReminder->save();

            Reminder::destroy($reminder->id);
        }
    }
}
