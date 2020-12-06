<?php
namespace TextSlack;
use Illuminate\Http\Request;

class RequestParser {
    protected $from;
    protected $to;
    protected $message;
    public function __construct(Request $request)
    {
        if ( $this->type == 'message-received' ) {
            $this->to = $request->to;
            $this->from = $request->message->from;
            $this->message = $request->message->text;
        }
    }

    public function get()
    {
        return (object)[
            'to' => $this->to,
            'from' => $this->from,
            'message' => $this->message,
        ];
    }
}