<?php namespace App\Http\Controllers;


use App\Models\Notification;
use App\Models\Connection;
use App\Models\Source;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Laravel\Socialite\Facades\Socialite as Socialize;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ConnectController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    function getConnectToNetwork($network)
    {
        switch ($network) {
            case "trello":
                return Socialize::with('trello')->redirect();
                break;

            default:
                return view("errors.500");
                break;
        }
    }

    function getCallbackFromNetwork($network)
    {
        switch ($network) {

            case "trello":
                $trello = Socialize::with('trello')->user();

                $token = $trello->token;
                $tokenSecret = $trello->tokenSecret;

                Session::put('token', $trello->token);
                Session::put('tokenSecret', $trello->tokenSecret);
                Session::put('user', $trello->user);

                return Redirect::to("/");

                break;

            default:
                return view("errors.500");
                break;
        }
    }
}
