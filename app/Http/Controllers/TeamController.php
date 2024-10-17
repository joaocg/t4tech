<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Http\Resources\TeamResource;
use App\Http\Requests\TeamRequest;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeamController extends Controller
{
    protected $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
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
        try {
            $team = $this->teamRepository->create($request->validated());
            return new TeamResource($team);
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
        try{
            $team = $this->teamRepository->update($id, $request->validated());
            return new TeamResource($team);
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
        $this->teamRepository->delete($id);
        return response()->json(['message' => 'Team deleted successfully']);
    }
}
