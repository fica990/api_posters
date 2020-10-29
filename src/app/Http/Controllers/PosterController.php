<?php

namespace App\Http\Controllers;

use App\Services\PosterService;
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
            $this->posterService->create($posterData, $imageId);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json(['asdsdfsdf'], 201);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
