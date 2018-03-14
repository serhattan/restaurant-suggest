<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Entity\GenerateDetail;
use App\Models\DB;

class GenerateDetailManager
{
    public static function mapExternal($data)
    {
        $generateDetail = new GenerateDetail();
        if (isset($data['id'])) {
            $generateDetail->setId($data['id']);            
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
        if (empty($generateDetail->getId())) {
            $newGenerateDetail->id = Helper::generateId();
            $generateDetail->setId($newGenerateDetail->id);
        } else {
            $newGenerateDetail = DB\GenerateDetail::where('id', $generateDetail->getId())->first();
        }
        
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
