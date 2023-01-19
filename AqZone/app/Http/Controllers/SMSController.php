<?php

namespace App\Http\Controllers;

use Couchbase\User;
use Illuminate\Http\Request;
use Vonage\Voice\Endpoint\App;
use function React\Promise\all;

class SMSController extends Controller
{
    public function send(Request $request){
        return view('auth.sms');
    }

    public function sms_process(Request $request){

        #twillio sms
        $to = \request("user_number");
        $from = getenv("TWILIO_FROM");
        $message = \request("message");
        //open connection

        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").'/Messages.json', getenv("TWILIO_SID")));
        curl_setopt($ch, CURLOPT_POST, 3);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='.$to.'&From='.$from.'&Body='.$message);

        // execute post
        $result = curl_exec($ch);
        $result = json_decode($result);

        // close connection
        curl_close($ch);
        //Sending message ends here
        return [$result];


    }
    public function sms_process_check(Request $request){
        return redirect('/');
    }

}
