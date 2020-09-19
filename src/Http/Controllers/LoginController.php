<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Http\Controllers;

use Iosum\AdminAuth\Traits\Authenticate;
use Iosum\Base\Http\Controllers\Controller;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    use Authenticate;

    protected $maxAttempts = 5; // Default is 5
    protected $decayMinutes = 1; // Default is 1

    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = Client::whereNull('user_id')
            ->where('provider', 'admins')
            ->where('password_client', 1)
            ->where('revoked', 0)
            ->first();
    }
}
