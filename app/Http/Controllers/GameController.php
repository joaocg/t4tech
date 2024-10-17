<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Http\Resources\GameResource;
use App\Http\Requests\GameRequest;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GameController extends Controller
{
    protected $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $games = $this->gameRepository->all();
        return GameResource::collection($games);
    }

    /**
     * @param GameRequest $request
     * @return GameResource
     * @throws AuthorizationException
     */
    public function store(GameRequest $request): GameResource
    {
        try {
            $game = $this->gameRepository->create($request->validated());
            return new GameResource($game);
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
     * @return GameResource
     */
    public function show(int $id): GameResource
    {
        $game = $this->gameRepository->find($id);
        return new GameResource($game);
    }

    /**
     * @param GameRequest $request
     * @param int $id
     * @return GameResource
     * @throws AuthorizationException
     */
    public function update(GameRequest $request, int $id): GameResource
    {
        try {
            $game = $this->gameRepository->update($id, $request->validated());
            return new GameResource($game);
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
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        $this->gameRepository->delete($id);
        return response()->json(['message' => 'Game deleted successfully']);
    }
}
