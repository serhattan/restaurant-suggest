<?php

namespace App\Models;

use App\Models\DB;
use App\Models\Entity;
use App\Helpers\Helper;

class UserManager
{
    /**
     * @param $userData
     * @return Entity\User
     */
    public static function map(DB\User $userData)
    {
        $user = new Entity\User();
        $user->setId($userData->id);
        $user->setFirstName($userData->first_name);
        $user->setLastName($userData->last_name);
        $user->setEmail($userData->email);
        $user->setStatus($userData->status);
        $user->setLanguage($userData->language);

        if ($userData->relationLoaded('avatar') && !empty($userData->avatar)) {
            $user->setAvatar($userData->avatar);
        }

        if ($userData->relationLoaded('groups') && !empty($userData->groups)) {
            $user->setGroups($userData->groups);
        }

        return $user;
    }

    /**
     * @param DB\User[] $users
     * @return Entity\User[]
     */
    public static function multiMap($users)
    {
        $userList = [];
        foreach ($users as $user) {
            $userList[] = self::map($user);
        }

        return $userList;
    }

    public static function getUserByEmail($email)
    {
        $user = DB\User::where('email', $email)->get();
        $mappedUser = self::multiMap($user);

        return $mappedUser;
    }

    public static function delete(Entity\User $user)
    {
        DB\GroupUser::where('user_id', $user->getId())->update(['status', Helper::STATUS_DELETED]);
        DB\RestaurantUser::where('user_id', $user->getId())->update(['status', Helper::STATUS_DELETED]);

        $user->setStatus(Helper::STATUS_DELETED);

        if ($user->save()) {
            return true;
        }
        return false;
    }

    public static function update(Entity\User $user)
    {
        if ($user->getId()) {
            $model = DB\User::where('id', $user->getId())
                ->update(['language' => $user->getLanguage()]);
        }

        return $model;
    }

    public static function save(Entity\User $user)
    {
        if (!Helper::isNull($user->getId())) {
            $model = DB\User::find($user->getId());
        }

        if ($model instanceof DB\User) {
            $model->id = $user->getId();
            $model->first_name = $user->getFirstName();
            $model->last_name = $user->getLastName();
            $model->email = $user->getEmail();
            $model->avatar = $user->getAvatar();
            $model->status = $user->getStatus();

            return $model->save();
        }
    }
}
