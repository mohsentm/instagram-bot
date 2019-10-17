<?php

namespace App\Services\ControllersService\Auth;

use App\Models\User;
use App\Repositories\UserRepositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserRegisterService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     * @throws \App\Exceptions\RepositoryException
     */
    public function register(array $data): User
    {
        $user = $this->create($data);
        event(new Registered($user));
        return $user;
    }

    /**
     * @param array $data
     * @return User
     * @throws \App\Exceptions\RepositoryException
     */
    public function create(array $data): User
    {
        return $this->userRepository->create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => UserRepository::DEFAULT_STATUS,
        ]);
    }
}
