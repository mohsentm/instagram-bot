<?php

namespace App\Services\ControllersService\Auth;

use App\Repositories\UserRepositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class UserLoginService
{
    /** @var UserRepository  */
    private $userRepository;

    /**
     * UserLoginService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data): array
    {
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw new UnauthorizedException('Unauthorised');
        }
        $user = Auth::user();
        return [
            'access_token' => $user->createToken('MyApp')->accessToken
        ];
    }
}
