<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Container;
use OpenApi\Attributes as OA;

class ContainerController extends Controller
{
    public function index()
    {
        return response()->json(
            Container::with('logs')->get()
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'container_id' => [
                    'required',
                    'unique:containers',
                    'regex:/^[A-Z]{2}[0-9]{5}$/'
                ],
                'waste_type' => 'required',
                'weight_kg' => 'required|numeric|min:10|max:5000'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        if (
            $request->waste_type == "Chemical"
            &&
            $request->weight_kg > 1000
        ) {
            return response()->json([
                'weight_kg' => [
                    'Chemical tidak boleh >1000kg'
                ]
            ], 422);
        }

        $container = Container::create([
            'container_id' => $request->container_id,
            'waste_type' => $request->waste_type,
            'weight_kg' => $request->weight_kg,
            'status' => 'Active'
        ]);

        return response()->json(
            $container,
            201
        );
    }

    public function archive($id)
    {
        $container = Container::where(
            'container_id',
            $id
        )->first();

        if (!$container) {
            return response()->json([
                'message' => 'Not Found'
            ],404);
        }

        $container->status = "Archived";

        $container->save();

        return response()->json($container);
    }

    public function destroy($id)
    {
        $container = Container::where(
            'container_id',
            $id
        )->first();

        if (!$container) {
            return response()->json([
                'message'=>'Not Found'
            ],404);
        }

        $container->delete();

        return response()->json([
            'message'=>'Deleted'
        ]);
    }

#[OA\Get(
    path: "/api/v1/gateway/containers/search",
    summary: "Search Containers",
    tags: ["Containers"]
)]
#[OA\Response(
    response: 200,
    description: "Search Result"
)]
    public function search(Request $request)
    {
        $query = Container::query();

        if ($request->type) {
            $query->where(
                'waste_type',
                $request->type
            );
        }

        if ($request->min_weight) {
            $query->where(
                'weight_kg',
                '>=',
                $request->min_weight
            );
        }

        return response()->json(
            $query->get()
        );
    }

#[OA\Get(
    path: "/api/v1/gateway/containers/{id}/logs",
    summary: "Container Tracking Logs",
    tags: ["Containers"]
)]
#[OA\Parameter(
    name: "id",
    in: "path",
    required: true
)]
#[OA\Response(
    response: 200,
    description: "Tracking Logs"
)]
    public function logs($id)
    {
        $container = Container::where(
            'container_id',
            $id
        )->first();

        if (!$container) {
            return response()->json([
                'message'=>'Not Found'
            ],404);
        }

        return response()->json(
            $container->logs
        );
    }
}