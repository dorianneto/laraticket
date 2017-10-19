<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * [$userRepository description]
     * @var [UserRepository]
     */
    protected $userRepository;

    /**
     * [__construct description]
     * @param UserRepository $userRepository [description]
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /**
     * [profile description]
     * @param  UserRequest $request [description]
     * @return [type]               [description]
     */
    public function profile()
    {
        $data = Auth::user();

        return view('modules.user.profile', compact('data'));
    }

    /**
     * [profileUpdate description]
     * @param  UserRequest $request [description]
     * @return [type]               [description]
     */
    public function profileUpdate(UserRequest $request)
    {
        try {
            $entry = $request->except(['_token', '_method']);

            array_walk($entry, function(&$value, $key) {
                switch ($key) {
                    case 'password':
                        $value = !empty($value) ? Hash::make($value) : false;
                        break;
                    case 'current_password':
                    case 'password_confirmation':
                        $value = false;
                        break;
                    default:
                        $value = !empty($value) ? $value : null;
                        break;
                }
            });

            $data = array_filter($entry, function($value) {
                return ($value !== false);
            });

            $this->userRepository->update(Auth::user()->id, $data);

            $notice = [
                'status' => 'success',
                'message' => 'Configurações atualizadas com sucesso!'
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => $exception->getMessage()
            ];
        }

        return redirect()->route('dashboard.index')->with(compact('notice'));
    }
}
