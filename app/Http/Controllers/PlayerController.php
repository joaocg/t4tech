<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PlayerRepositoryInterface;
use App\Services\BallDontLieService;
use Exception;
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
        try {
            $data = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'position' => 'required|string',
                'team_id' => 'required|integer|exists:teams,id',
            ]);
    
            return response()->json($this->playerRepository->create($data), 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors with a 422 Unprocessable Entity status
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            // Catch any other exception and return a 500 error response
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $data = $request->validate([
                'first_name' => 'string',
                'last_name' => 'string',
                'position' => 'string',
                'team_id' => 'integer|exists:teams,id',
            ]);
    
            return response()->json($this->playerRepository->update($id, $data));
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors with a 422 Unprocessable Entity status
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            // Catch any other exception and return a 500 error response
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
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

