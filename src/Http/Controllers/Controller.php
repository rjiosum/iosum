<?php


namespace Iosum\Base\Http\Controllers;



use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;
use Iosum\Base\Traits\FlashMessages;

class Controller extends BaseController
{
    use FlashMessages;

    /**
     * @var null
     */
    protected $data = null;

    /**
     * @param $title
     * @param $subTitle
     */
    protected function setPageTitle($title, $subTitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }

    /**
     * @param int $errorCode
     * @param null $message
     * @return Response
     */
    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    /**
     * @param $route
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    /**
     * @param $message
     * @param string $type
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirectBack($message, $type = 'info')
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }

    /**
     * @param bool $status
     * @param null $data
     * @param array $message
     * @param int $responseCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($status = true, $data = null, $message = [], $responseCode = Response::HTTP_OK)
    {
        return response([
                'status' => $status,
                'data' => $data,
                'message' => $message
            ], $responseCode);
    }
}