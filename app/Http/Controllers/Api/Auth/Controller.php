<?php namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\LoginPost;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class Controller
 * @package App\Http\Controllers\Auth
 */
class Controller extends BaseController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Controller constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    /**
     * Authenticates user credentials and returns api access token on success
     *
     * @param LoginPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(LoginPost $request)
    {
        $user = $this->userRepository->findByEmail($request->email);
        if (!$user || !Hash::check($request->password, $user->getAuthPassword())) {
            return response()->json('Invalid credentials', 422);
        }
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response()->json(compact('token', 'user'));
    }

    /**
     * Revokes the current api users access token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user('api');
        if (!is_null($user)) {
            $token = $user->token();
            optional($token)->revoke();
        }

        return response()->json('You have been logged out');
    }

    public function updateToken(Request $request)
    {

    }
}