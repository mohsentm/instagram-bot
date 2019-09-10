<?php

namespace App\Services\ControllersService\Auth;

use App\Models\User;
use App\Repositories\UserRepositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserRegisterService
{
    /** @var string */
    public const STATUS_ENABLE = 'ENABLE';
    /** @var string */
    public const STATUS_DISABLE = 'DISABLE';
    /** @var array */
    public const STATUS_LIST = [self::STATUS_ENABLE, self::STATUS_DISABLE];
    /** @var string */
    public const DEFAULT_STATUS = self::STATUS_DISABLE;

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
            'status' => self::DEFAULT_STATUS,
        ]);
    }
}
