<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Iosum\AdminAuth\Http\Resources\Shared\AdminResource;
use Iosum\AdminAuth\Traits\IssueToken;
use Iosum\Base\Http\Controllers\Controller;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    use AuthenticatesUsers, IssueToken;

    protected int $maxAttempts = 5; // Default is 5
    protected int $decayMinutes = 1; // Default is 1

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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws ValidationException
     */
    protected function sendLoginResponse(Request $request)
    {
        $user = $this->guard()->user();

        $this->clearLoginAttempts($request);
        $response = $this->issueToken($request, 'password');

        if ($response->getStatusCode() != 200) {
            return $this->sendFailedLoginResponse($request);
        }

        $data = json_decode($response->getContent());

        $param = $this->cookieParams($data->access_token);

        if ($request->has('remember') && $request->remember) {
            $param['minutes'] = 2628000; //five years
        }

        $cookie = Cookie::make($param['name'], $param['value'], $param['minutes'], $param['path'], $param['domain'], $param['secure'], $param['httponly'], $param['raw'], $param['samesite']);

        return $this->responseJson(true, new AdminResource($user), trans('admin-auth::auth.login'), Response::HTTP_OK)->withCookie($cookie);
    }

    /**
     * @param $token
     * @return array
     */
    private function cookieParams($token): array
    {
        return [
            'name' => config('passport.admin.cookie.name'),
            'value' => $token,
            'minutes' => config('passport.admin.cookie.minutes'), //0 means cookie will expires when browser is closed
            'path' => config('passport.admin.cookie.path'),
            'domain' => config('passport.admin.cookie.domain'),
            'secure' => config('passport.admin.cookie.secure'),
            'httponly' => config('passport.admin.cookie.httponly'),
            'raw' => config('passport.admin.cookie.raw'),
            'samesite' => config('passport.admin.cookie.samesite'),
        ];
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
