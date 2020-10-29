<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Throwable;

class ImageController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }


    public function index(): JsonResponse
    {
        return response()->json($this->imageService->nonPosters());
    }


    public function store(StoreImageRequest $request)
    {
        $image = $request->all();

        try {
            $this->imageService->create($image);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response(null, 201);
    }


    public function destroy($id)
    {
        $this->imageService->delete($id);

        return response(null, 200);
    }
}
