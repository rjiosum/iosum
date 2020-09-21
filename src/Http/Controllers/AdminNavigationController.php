<?php declare(strict_types=1);

namespace Iosum\AdminNav\Http\Controllers;

use Illuminate\Http\Response;
use Iosum\AdminNav\Contracts\CreateAdminNavigation as CreateAdminNavigationInterface;
use Iosum\AdminNav\Contracts\DeleteAdminNavigation as DeleteAdminNavigationInterface;
use Iosum\AdminNav\Contracts\FetchAdminNavigation as FetchAdminNavigationInterface;
use Iosum\AdminNav\Contracts\FetchAdminNavigationTree as FetchAdminNavigationTreeInterface;
use Iosum\AdminNav\Contracts\FindAdminNavigation as FindAdminNavigationInterface;
use Iosum\AdminNav\Contracts\UpdateAdminNavigation as UpdateAdminNavigationInterface;
use Iosum\AdminNav\Http\Requests\AdminNavigationStoreRequest;
use Iosum\AdminNav\Http\Requests\AdminNavigationUpdateRequest;
use Iosum\AdminNav\Http\Resources\AdminNavigationResource;
use Iosum\AdminNav\Http\Resources\AdminNavigationTreeResource;
use Iosum\AdminNav\Models\AdminNavigation;
use Iosum\Base\Http\Controllers\Controller;

class AdminNavigationController extends Controller
{

    /**
     * Get resource list
     *
     * @param int $parentId
     * @param FetchAdminNavigationInterface $fetchAdminNavigation
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(
        $parentId = 0,
        FetchAdminNavigationInterface $fetchAdminNavigation
    )
    {
        return AdminNavigationResource::collection($fetchAdminNavigation->get($parentId));
    }

    /**
     * Get resource tree
     *
     * @param FetchAdminNavigationTreeInterface $fetch
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function tree(FetchAdminNavigationTreeInterface $fetch)
    {
        return AdminNavigationTreeResource::collection($fetch->getTree());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminNavigationStoreRequest $request
     * @param CreateAdminNavigationInterface $create
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        AdminNavigationStoreRequest $request,
        CreateAdminNavigationInterface $create
    )
    {
        $navigation = $create->createAdminNavigation($request->all());

        return $this->responseJson(
            (bool)$navigation,
            new AdminNavigationResource($navigation),
            (bool)$navigation ? trans('base::response.success.create', ['attribute' => 'Navigation'])
                : trans('base::response.error.create', ['attribute' => 'Navigation']),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminNavigationUpdateRequest $request
     * @param AdminNavigation $nav
     * @param UpdateAdminNavigationInterface $update
     * @param FindAdminNavigationInterface $find
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        AdminNavigationUpdateRequest $request,
        AdminNavigation $nav,
        UpdateAdminNavigationInterface $update,
        FindAdminNavigationInterface $find
    )
    {
        $request->merge(['id' => $nav->id]);

        $status = $update->updateAdminNavigation($request->all());

        return $this->responseJson(
            (bool)$status,
            new AdminNavigationResource($find->findById($nav->id)),
            (bool)$status ? trans('base::response.success.update', ['attribute' => 'Navigation'])
                : trans('base::response.error.update', ['attribute' => 'Navigation']),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AdminNavigation $nav
     * @param DeleteAdminNavigationInterface $delete
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(
        AdminNavigation $nav,
        DeleteAdminNavigationInterface $delete
    )
    {
        $status = $delete->deleteAdminNavigation($nav->id);

        return $this->responseJson(
            (bool)$status,
            [],
            (bool)$status ? trans('base::response.success.delete', ['attribute' => 'Navigation'])
                : trans('base::response.error.delete', ['attribute' => 'Navigation']),
            Response::HTTP_OK
        );
    }
}
