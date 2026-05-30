<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class GatewayController extends Controller
{
    protected $containerController;

    public function __construct(
        ContainerController $containerController
    )
    {
        $this->containerController =
            $containerController;
    }

#[OA\Get(
    path: "/api/v1/gateway/containers",
    summary: "Get All Containers",
    tags: ["Containers"]
)]
#[OA\Response(
    response: 200,
    description: "List of containers"
)]
    public function containers()
    {
        return $this->containerController
                    ->index();
    }

#[OA\Post(
    path: "/api/v1/gateway/containers",
    summary: "Create Container",
    tags: ["Containers"]
)]
#[OA\RequestBody(
    required: true,
    content: new OA\JsonContent(
        required: ["container_id", "waste_type", "weight_kg"],
        properties: [
            new OA\Property(
                property: "container_id",
                type: "string",
                example: "AB12345"
            ),
            new OA\Property(
                property: "waste_type",
                type: "string",
                example: "Plastic"
            ),
            new OA\Property(
                property: "weight_kg",
                type: "number",
                example: 500
            )
        ]
    )
)]
#[OA\Response(
    response: 201,
    description: "Container Created"
)]
    public function storeContainer(
        Request $request
    )
    {
        return $this->containerController
                    ->store($request);
    }

#[OA\Patch(
    path: "/api/v1/gateway/containers/{id}/archive",
    summary: "Archive Container",
    tags: ["Containers"]
)]
#[OA\Parameter(
    name: "id",
    in: "path",
    required: true
)]
#[OA\Response(
    response: 200,
    description: "Container Archived"
)]

    public function archive(
        $id
    )
    {
        return $this->containerController
                    ->archive($id);
    }

#[OA\Delete(
    path: "/api/v1/gateway/containers/{id}",
    summary: "Delete Container",
    tags: ["Containers"]
)]
#[OA\Parameter(
    name: "id",
    in: "path",
    required: true
)]
#[OA\Response(
    response: 200,
    description: "Container Deleted"
)]
    public function delete(
        $id
    )
    {
        return $this->containerController
                    ->destroy($id);
    }
}
