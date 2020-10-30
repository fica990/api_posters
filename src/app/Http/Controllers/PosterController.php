<?php

namespace App\Http\Controllers;

use App\Services\PosterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class PosterController extends Controller
{
    private PosterService $posterService;

    public function __construct(PosterService $posterService)
    {
        $this->posterService = $posterService;
    }


    public function store(Request $request, $imageId)
    {
        $posterData = $request->all();

        try {
            $poster = $this->posterService->create($posterData, $imageId);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => $e->getMessage()], 500);
        }

        return new JsonResponse(['id' => $poster->id, 'url' => url('storage' . $poster->path . $poster->name)], 201);
    }


    public function update(Request $request, $id)
    {
        $posterData = $request->all();

        try {
            $poster = $this->posterService->edit($posterData, $id);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => $e->getMessage()], 500);
        }

        return new JsonResponse(['id' => $poster->id, 'url' => url('storage' . $poster->image->path . $poster->name)], 200);
    }


    public function destroy($id)
    {
        $this->posterService->delete($id);

        return response(null, 200);
    }
}
