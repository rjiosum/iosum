<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Iosum\AdminAuth\Http\Resources\Shared\AdminResource;
use Iosum\Base\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->user('api:admin')){
            return $this->responseJson(false, [], '', Response::HTTP_PRECONDITION_FAILED);
        }
        return $this->responseJson(true, new AdminResource($request->user('api:admin')), '', Response::HTTP_OK);
    }
}
