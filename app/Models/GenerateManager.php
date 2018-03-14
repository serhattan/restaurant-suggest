<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Entity\Generate;
use App\Models\DB;

class GenerateManager
{
    public static function mapExternal($data)
    {
        $generate = new Generate();
        if (isset($data['id'])) {
            $generate->setId($data['id']);
        }
        $generate->setGroupId($data['groupId']);
        $generate->setRestaurantId($data['restaurantId']);
        $generate->setGenerateDetailId($data['generateDetailId']);

        return $generate;
    }
    /**
     * @param Generate $generate
     * @return bool
     */
    public static function save(Generate $generate)
    {
        $newGenerate = new DB\Generate();
        
        if (empty($generate->getId())) {
            $newGenerate->id = Helper::generateId();
        } else {
            $newGenerate = DB\Generate::where('id', $generate->getId())->first();
        }

        $newGenerate->group_id = $generate->getGroupId();
        $newGenerate->generate_detail_id = $generate->getGenerateDetailId();
        $newGenerate->restaurant_id = $generate->getRestaurantId();

        return  $newGenerate->save();
    }
}
