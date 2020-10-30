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
        return new JsonResponse($this->imageService->all());
    }


    public function store(StoreImageRequest $request)
    {
        $imageData = $request->all();

        try {
            $this->imageService->create($imageData);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => $e->getMessage()], 500);
        }

        return new JsonResponse([route('filesystem.path', ['bucket' => $imageData['path'], 'filePath' => $imageData['name']])], 201);
    }


    public function destroy($id)
    {
        $this->imageService->delete($id);

        return response(null, 200);
    }
}
