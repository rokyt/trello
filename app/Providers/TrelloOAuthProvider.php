<?php
namespace App\Providers;

use League\OAuth1\Client\Server\Trello;

class TrelloOAuthProvider extends Trello
{
    /**
     * Application expiration
     *
     * @var string
     */
    protected $applicationExpiration;

    /**
     * Application key
     *
     * @var string
     */
    protected $applicationKey;

    /**
     * Application name
     *
     * @var string
     */
    protected $applicationName = 'Trello Board/List Debugger inClass';


    /**
     * Application scope
     *
     * @var string
     */
    protected $applicationScope;
}
