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
use Illuminate\Support\Facades\Response;

class ApiController extends Controller {

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
    function getBoardsAndList()
    {
        $session = Session::all();

        $boardData = [];

        $trello = new \Trello\Trello(env("TRELLO_KEY"), env("TRELLO_SECRET"), $session["token"], $session["tokenSecret"]);
        $boards = $trello->members->get('me/boards');
        if ($boards !== false)
        {
            foreach ($boards as $board)
            {
                $listData = [];
                $lists = $trello->boards->get($board->id."/lists");
                if ($lists !== false)
                {
                    foreach ($lists as $list)
                    {
                        $listData[$list->id] = $list->name;
                    }

                    $boardData[$board->id] = [
                        "name"		=> $board->name,
                        "lists"		=> $listData
                    ];
                }
            }
        }

        return Response::json($boardData);
    }
}
