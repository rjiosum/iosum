<?php declare(strict_types=1);

namespace Iosum\AdminNav\Http\Controllers;

use Iosum\AdminNav\Http\Resources\{
    AdminNavigationCollectionResource,
    AdminNavigationTreeCollectionResource,
    AdminNavigationResource
};
use Iosum\AdminNav\Contracts\{
    CreateAdminNavigationInterface,
    DeleteAdminNavigationInterface,
    FetchAdminNavigationInterface,
    FetchAdminNavigationTreeInterface,
    FindAdminNavigationInterface,
    UpdateAdminNavigationInterface
};
use Iosum\AdminNav\Http\Requests\{AdminNavigationStoreRequest, AdminNavigationUpdateRequest};
use Iosum\AdminNav\Models\AdminNavigation;
use Illuminate\Http\Response;
use Iosum\Base\Http\Controllers\Controller;

class AdminNavigationController extends Controller
{

    /**
     * Get resource list
     *
     * @param int $parentId
     * @param FetchAdminNavigationInterface $fetchAdminNavigation
     * @return AdminNavigationCollectionResource
     */
    public function index(
        $parentId = 0,
        FetchAdminNavigationInterface $fetchAdminNavigation
    )
    {
        return new AdminNavigationCollectionResource($fetchAdminNavigation->get($parentId));
    }

    /**
     * Get resource tree
     *
     * @param FetchAdminNavigationTreeInterface $fetch
     * @return AdminNavigationTreeCollectionResource
     */
    public function tree(FetchAdminNavigationTreeInterface $fetch)
    {
        return new AdminNavigationTreeCollectionResource($fetch->getTree());
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
