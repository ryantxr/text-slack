<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TextSlack\SmsNotification;
use TextSlack\RequestParser;
use App\Notifications\InboundSmsMessage;

class BandEventController extends Controller
{
    /**
     * Event
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function event(Request $request)
    {
        if ( $request->isJson() ) {
            Log::debug("Received JSON");
        }
        Log::debug(print_r($request->all(), true));

        $notification = new SmsNotification;
        $inboundMessage = new InboundSmsMessage($request);
        $notification->notify($inboundMessage);

        return ['message' => 'OK'];

    }
    /**
     * Status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        Log::debug(print_r($request->all(), true));
        return ['message' => 'OK'];

    }
    
    /**
     *
     * Put a comment here.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ping(Request $request)
    {
        return "pong";
    }
}
