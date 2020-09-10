<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Iosum\Base\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Logout user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user('api:admin')->token()->revoke();

        $cookie = Cookie::forget(config('passport.admin.cookie.name'));

        return $this->responseJson(true, [], trans('admin-auth::auth.logout'), Response::HTTP_OK)->withCookie($cookie);
    }
}
