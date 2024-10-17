<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PlayerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    protected $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->playerRepository->all());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->playerRepository->find($id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'position' => 'required|string',
            'team_id' => 'required|integer|exists:teams,id',
        ]);

        return response()->json($this->playerRepository->create($data), 201);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'position' => 'string',
            'team_id' => 'integer|exists:teams,id',
        ]);

        return response()->json($this->playerRepository->update($id, $data));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->playerRepository->delete($id));
    }
}

