<?php declare(strict_types=1);


namespace  Iosum\AdminAuth\Traits;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Iosum\AdminAuth\Http\Resources\AdminResource;


trait Authenticate
{
    use IssueToken, ThrottlesLogins;

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
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
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     *
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get the cookie parameters to be used during authentication.
     *
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
}
