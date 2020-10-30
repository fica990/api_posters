<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Services\AlbumService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AlbumController extends Controller
{
    private AlbumService $albumService;

    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }


    public function index(): JsonResponse
    {
        return new JsonResponse($this->albumService->all());
    }


    public function store(StoreAlbumRequest $request)
    {
        $albumData = $request->all();

        try {
            $this->albumService->create($albumData);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => $e->getMessage()], 500);
        }

        return response(null, 201);
    }


    public function show($id)
    {
        return new JsonResponse($this->albumService->show($id));
    }


    public function update(Request $request, $id)
    {
        $albumData = $request->all();

        $this->albumService->edit($albumData, $id);

        return response(null, 200);
    }


    public function destroy($id)
    {
        $this->albumService->delete($id);

        return response(null, 200);
    }
}
