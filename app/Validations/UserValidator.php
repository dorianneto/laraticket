<?php

namespace App\Validations;

use App\Repositories\UserRepository;
use Validator;
use Hash;

class UserValidator
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
        $this->userRepository = $userRepository;
    }

    /**
     * [validate description]
     * @return [type] [description]
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        if (count($parameters) < 1) { return false;}

        $user_id = $parameters[0];
        $user = $this->userRepository->findFor($user_id);

        return (Hash::check($value, $user->password) === true);
    }
}
