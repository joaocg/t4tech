<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Http\Resources\TeamResource;
use App\Http\Requests\TeamRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeamController extends Controller
{
    protected $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->middleware('auth:sanctum');
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $teams = $this->teamRepository->all();
        return TeamResource::collection($teams);
    }

    /**
     * @param TeamRequest $request
     * @return TeamResource
     * @throws AuthorizationException
     */
    public function store(TeamRequest $request): TeamResource
    {
        $this->authorize('create', Team::class);

        $team = $this->teamRepository->create($request->validated());
        return new TeamResource($team);
    }

    /**
     * @param int $id
     * @return TeamResource
     */
    public function show(int $id): TeamResource
    {
        $team = $this->teamRepository->find($id);
        return new TeamResource($team);
    }

    /**
     * @param TeamRequest $request
     * @param int $id
     * @return TeamResource
     * @throws AuthorizationException
     */
    public function update(TeamRequest $request, int $id): TeamResource
    {
        $this->authorize('update', Team::class);

        $team = $this->teamRepository->update($id, $request->validated());
        return new TeamResource($team);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        $this->authorize('delete', Team::class);

        $this->teamRepository->delete($id);
        return response()->json(['message' => 'Team deleted successfully']);
    }
}
