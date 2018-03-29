<?php

namespace App\Models;

use App\Models\DB;
use App\Helpers\Helper;
use App\Models\Entity\Generate;
use App\Models\Entity\GenerateUserLike;
use App\Models\Entity\GenerateDetail;
use Illuminate\Support\Facades\Auth;

class GenerateManager
{
    /**
     * @param DB\Generate $data
     * @return Generate
     */
    public static function map(DB\Generate $data)
    {
        $generate = new Generate();
        $generate->setId($data->id);
        $generate->setGroupId($data->group_id);
        $generate->setRestaurantId($data->restaurant_id);
        $generate->setGenerateDetailId($data->generate_detail_id);
        $generate->setOrderNo($data->order_no);

        if ($data->relationLoaded('restaurant') && !empty($data->restaurant)) {
            $generate->setRestaurant(RestaurantManager::map($data->restaurant));
        }

        return $generate;
    }

    /**
     * @param Entity\Group $group
     * @return array
     */
    public static function groupMap(Entity\Group $group)
    {
        $data = [
            'id' => $group->getId(),
            'budget' => $group->getBudget(),
            'restaurants' => []
        ];

        foreach ($group->getRestaurants() as $restaurant) {
            $data['restaurants'][$restaurant->getId()] = [
                'id' => $restaurant->getId(),
                'averagePrice' => $restaurant->getAveragePrice(),
                'regenerateCount' => $restaurant->getRegenerateCount()
            ];
        }

        return $data;
    }

    public static function generateUserLikeMap(DB\GenerateUserLike $data)
    {
        $generateUserLike = new GenerateUserLike();
        $generateUserLike->setId($data->id);
        $generateUserLike->setUserId($data->user_id);
        $generateUserLike->setGenerateId($data->generate_id);
        $generateUserLike->setIsLike($data->isLike);

        if ($data->relationLoaded('user') && !empty($data->user)) {
            $generateUserLike->setUser(UserManager::map($data->user));
        }

        if ($data->relationLoaded('generate') && !empty($data->generate)) {
            $generateUserLike->setGenerate(GenerateManager::map($data->generate));
        }

        return $generateUserLike;
    }

    public static function saveGenerateUserLike($generateId, $isLike)
    {
        $generateUserLike = new DB\GenerateUserLike();

        $generateUserLike->id = Helper::generateId();
        $generateUserLike->user_id = Auth::id();
        $generateUserLike->generate_id = $generateId;
        $generateUserLike->isLike = $isLike;
        $generateUserLike->save();

        return $generateUserLike;
    }

    /**
     * @param $data
     * @return Generate
     */
    public static function mapExternal($data)
    {
        $generate = new Generate();
        if (isset($data['id'])) {
            $generate->setId($data['id']);
        }
        $generate->setGroupId($data['groupId']);
        $generate->setRestaurantId($data['restaurantId']);
        $generate->setGenerateDetailId($data['generateDetailId']);
        $generate->setOrderNo($data['orderNo']);

        return $generate;
    }

    /**
     * @param Generate $generate
     * @return bool
     */
    public static function save(Generate $generate)
    {
        $newGenerate = new DB\Generate();

        self::removeGenerate($generate->getGroupId());

        $newGenerate->id = Helper::generateId();
        $newGenerate->group_id = $generate->getGroupId();
        $newGenerate->generate_detail_id = $generate->getGenerateDetailId();
        $newGenerate->restaurant_id = $generate->getRestaurantId();
        $newGenerate->order_no = $generate->getOrderNo();
        $newGenerate->save();

        return $newGenerate;
    }

    public static function removeGenerate($groupId)
    {
        return DB\Generate::where('group_id', $groupId)->delete();
    }

    public static function saveForGenerateDetail(GenerateDetail $generateDetail)
    {
        $newGenerate = new DB\Generate();

        self::removeGenerate($generateDetail->getGroupId());

        $newGenerate->id = Helper::generateId();
        $newGenerate->group_id = $generateDetail->getGroupId();
        $newGenerate->generate_detail_id = $generateDetail->getId();
        $newGenerate->restaurant_id = $generateDetail->getRestaurantId();
        $newGenerate->order_no = $generateDetail->getOrderNo();
        $newGenerate->save();

        return $newGenerate;
    }

    public static function get($groupId)
    {
        $generate = DB\Generate::with('restaurant')->where('group_id', $groupId)->first();

        if (!empty($generate)) {
            return self::externalMap($generate);
        }

        return false;
    }

    public static function getGeneratedRestaurantByUserId($userId)
    {
        $generatedData = [];
        $groupUsers = GroupUserManager::getGroupsByUserId($userId);

        foreach ($groupUsers as $groupUser) {
            $generatedRestaurant = null;
            $likeCount = $dislikeCount = 0;

            $generate = DB\Generate::with('restaurant')->where('group_id', $groupUser->getGroupId())->first();
            if (!empty($generate)) {
                $isLike = false;

                $generate = self::externalMap($generate);
                $generatedRestaurant = $generate->getRestaurant()->getName();
                $generateUserLike = DB\GenerateUserLike::where(['generate_id' => $generate->getId(), 'user_id' => $userId])->first();

                if (!empty($generateUserLike)) {
                    $generateUserLike = GenerateManager::generateUserLikeMap($generateUserLike);
                    $isLike = $generateUserLike->getIsLike();

                    $likeCount = DB\GenerateUserLike::where(['generate_id' => $generate->getId(), 'isLike' => Helper::LIKE])->count();
                    $dislikeCount = DB\GenerateUserLike::where(['generate_id' => $generate->getId(), 'isLike' => Helper::DISLIKE])->count();
                }

                $generatedData[] = [
                    'generateId' => $generate->getId(),
                    'generatedRestaurant' => $generatedRestaurant,
                    'isLike' => $isLike,
                    'likeCount' => $likeCount,
                    'dislikeCount' => $dislikeCount,
                    'groupName' => $groupUser->getGroup()->getName()
                ];
            }
        }

        return $generatedData;
    }


    public static function externalMap(DB\Generate $generateData)
    {
        $generate = new Entity\Generate();
        $generate->setId($generateData->id);
        $generate->setGroupId($generateData->group_id);
        $generate->setRestaurantId($generateData->restaurant_id);
        $generate->setGenerateDetailId($generateData->generate_detail_id);
        $generate->setOrderNo($generateData->order_no);

        if ($generateData->relationLoaded('restaurant') && !empty($generateData->restaurant)) {
            $generate->setRestaurant(RestaurantManager::map($generateData->restaurant));
        }

        return $generate;
    }
}
