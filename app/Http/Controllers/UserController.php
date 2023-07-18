<?php

namespace App\Http\Controllers;

use App\Service\UserService as ServiceUserService;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function registerUser(RegisterUserRequest $request)
    {
        $user = $this->service->register($request->validated());

        return response()->json([
            $user
        ], Response::HTTP_CREATED);
    }

    public function updateUser(User $user, UpdateUserRequest $request)
    {
        $user = $this->service->update($user, $request->validated());

        return response()->json([
            $user
        ], Response::HTTP_OK);
    }

    public function deleteUser(User $user)
    {
        Gate::authorize('delete-user');

        $this->service->delete($user);

        return response('User deleted succesfully', Response::HTTP_OK);
    }

    public function storeResult(User $user, Request $request)
    {
        Gate::authorize('store-results', $user);

        $validated = $request->validate([
            'result' => 'required'
        ]);

        $this->service->storeResults($user, $validated);

        return response()->json([
            $user->profile
        ], Response::HTTP_CREATED);
    }
}
