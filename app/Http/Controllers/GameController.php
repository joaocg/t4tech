<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Http\Resources\GameResource;
use App\Http\Requests\GameRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GameController extends Controller
{
    protected $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->middleware('auth:sanctum');
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
        $this->authorize('create', Game::class);

        $game = $this->gameRepository->create($request->validated());
        return new GameResource($game);
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
        $this->authorize('update', Game::class);

        $game = $this->gameRepository->update($id, $request->validated());
        return new GameResource($game);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        $this->authorize('delete', Game::class);

        $this->gameRepository->delete($id);
        return response()->json(['message' => 'Game deleted successfully']);
    }
}
