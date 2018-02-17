<?php

namespace App\Http\Controllers\Auth;

use App\Models\DB\User;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\GroupMemberManager;
use App\Models\GroupUserManager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\DB\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'id' => Helper::generateId(),
            'first_name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => Helper::STATUS_ACTIVE
        ]);

        if (!empty($user)) {
            $groupMembers = GroupMemberManager::getByEmail($data['email']);
            if (!empty($groupMembers)) {
                foreach ($groupMembers as $groupMember) {
                    GroupUserManager::save([
                        'userId' => $user->id,
                        'groupId' => $groupMember->getGroupId()
                    ]);
                }
            }
        }

        return $user;
    }
}
