<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class RegistrationController extends Controller
{
    public function confirmEmail($token)
    {
        $result = User::where('confirmation_code', '=', $token)->get();

        if (!$result->isEmpty())
        {
        User::whereConfirmationCode($token)->firstOrFail()->confirmEmail();

        flash()->success('Your account was successfully registered.');
        return redirect('/');
        }
        else
        {
            flash()->error('That code was incorrect, please make sure you follow the link in the verification email.');
            return redirect('/');
        }
    }

}
