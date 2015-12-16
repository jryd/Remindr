<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reminders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'userReminderDate', 'utcReminderDate', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'memberid');
    }
}
