<?php declare(strict_types=1);

namespace Iosum\ApiException\Exceptions;

use Illuminate\Http\Response;
use Iosum\ApiException\Contract\ExceptionResponseInterface;
use Iosum\ApiException\Traits\PrepareException;

class NotFoundHttpException implements ExceptionResponseInterface
{
    use PrepareException;

    /**
     * @param $exception
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response|mixed
     * @throws \ReflectionException
     * @throws \Throwable
     */
    public function response($exception)
    {
        $message = trans('api-exception::exception.http');

        if (config('app.debug')) {
            $message .= $this->responseHTML($exception);
        }

        $response['message'] = $message;

        return response($response, Response::HTTP_NOT_FOUND);
    }
}