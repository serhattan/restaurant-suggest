<?php

namespace App\Models;

use App\Models\DB;
use App\Helpers\Helper;
use App\Models\Entity\GenerateDetail;
use App\Service\Generate\Generate as GenerateService;

class GenerateDetailManager
{
    public static function map(DB\GenerateDetail $data)
    {
        $generateDetail = new GenerateDetail();

        $generateDetail->setId($data->id);
        $generateDetail->setGroupId($data->group_id);
        $generateDetail->setOrderNo($data->order_no);
        $generateDetail->setStatus($data->status);
        $generateDetail->setCreatedAt($data->created_at);
        $generateDetail->setData($data->data);
        $generateDetail->setRegenerateStatus($data->regenerate_status);
        $generateDetail->setRestaurantId($data->restaurant_id);
        $generateDetail->setTotalScore($data->total_score);

        if ($data->relationLoaded('restaurant') && !empty($data->restaurant)) {
            $generateDetail->setRestaurant(RestaurantManager::map($data->restaurant));
        }

        return $generateDetail;
    }

    public static function get($groupId, $orderNo = 1)
    {
        $newGenerate = DB\GenerateDetail::where(['group_id' => $groupId, 'order_no' => $orderNo])->first();

        if (empty($newGenerate)) {
            $generateService = new GenerateService();
            $generateService->handle($groupId);
            $newGenerate = DB\GenerateDetail::where(['group_id' => $groupId, 'order_no' => 1])->first();
        }

        return self::map($newGenerate);
    }

    public static function mapExternal($data)
    {
        $generateDetail = new GenerateDetail();
        if (isset($data['id'])) {
            $generateDetail->setId($data['id']);            
        } else {
            $generateDetail->setId(Helper::generateId());
        }
        
        $generateDetail->setGroupId($data['groupId']);
        $generateDetail->setRestaurantId($data['restaurantId']);
        $generateDetail->setStatus($data['status']);
        $generateDetail->setRegenerateStatus($data['regenerateStatus']);
        $generateDetail->setTotalScore($data['totalScore']);
        $generateDetail->setOrderNo($data['orderNo']);
        $generateDetail->setData($data['data']);

        return $generateDetail;
    }
    /**
     * @param GenerateDetail $generateDetail
     * @return bool
     */
    public static function save(GenerateDetail $generateDetail)
    {
        $newGenerateDetail = new DB\GenerateDetail();

        $newGenerateDetail->id = Helper::generateId();
        $newGenerateDetail->group_id = $generateDetail->getGroupId();
        $newGenerateDetail->restaurant_id = $generateDetail->getRestaurantId();
        $newGenerateDetail->status = $generateDetail->getStatus();
        $newGenerateDetail->regenerate_status = $generateDetail->getRegenerateStatus();
        $newGenerateDetail->total_score = $generateDetail->getTotalScore();
        $newGenerateDetail->order_no = $generateDetail->getOrderNo();
        $newGenerateDetail->data = $generateDetail->getData();
        $newGenerateDetail->save();
        return $newGenerateDetail;
    }
}
