<?php

namespace App;

use App\Helpers\Helper;
use App\Models\Entity\User;
use Illuminate\Database\Eloquent\Model;

class UserManager
{


    /**
     * @param $userData
     * @return Entity\User
     */

    public static function mapUser (DB\User $userData) {
        $user = new Entity\User();
        $user->setId($userData->id);
        $user->setFirstName($userData->first_name);
        $user->setLastName($userData->last_name);
        $user->setEmail($userData->email);
        $user->setStatus($userData->status);
        
        if (isset($userData->avatar)) {
            $user->setAvatar($userData->avatar);
        }

        if (isset($userData->groups)) {
            $user->setGroups($userData->groups);
        }
    }

    public static function getUserByEmail ($email) {
        $user = DB\User::where('email', $email)->get();
        $mappedUser = self::mapUser($user);

        return $mappedUser;
    }

    public static function delete (Entity\User $user) {
        try {
            
            DB\GroupUser::where('user_id', $user->getId())->delete();
            DB\RestaurantUser::where('user_id', $user->getId())->delete();
            
            $user->setStatus(Helper::STATUS_DELETED);
        } catch (\Exception $e) {
            return $e;
        }

        if ($user->save()) {
            return true;
        }
        return false;
    }

    public static function save (Entity\User $user) {
        if (!Helper::isNull($user->getId())) {
            $model = DB\User::find($user->getId());
        }

        if ($model instanceof DB\User) {
            $model->id = $user->getId();
            $model->first_name = $user->getName();
            $model->last_name = $user->getLastName();
            $model->email = $user->getEmail();
            $model->avatar = $user->getAvatar();
            $model->status = $user->getStatus();

            $model->save();

            return $user->getId();
        }
    }
}
