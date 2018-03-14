<?php

namespace App\Service\Generate;

use App\Models\DB\Group;
use App\Models\GroupManager;
use App\Models\GenerateManager;
use App\Models\GenerateDetailManager;
use App\Helpers\Helper;

class Generate
{
    const PRICE_PERFORMANCE_RATIO = 20;

    const CLASSES = [
        [
            'name' => 'App\Service\Generate\PriceRatio',
            'rate' => 20
        ],
        [
            'name' => 'App\Service\Generate\TotalScore',
            'rate' => 20
        ]
    ];

    public function handle($groupId)
    {
        $group = Group::with('restaurants')->where('id', $groupId)->first();
        $group = GroupManager::map($group);
        $data = $this->map($group);
    
        foreach (self::CLASSES as $class) {
            $model = new $class['name']($data, $class['rate']);
            $data = $model->handle();
        }

        $totalPointlist = $this->insertionSort($data['restaurants']);

        $restaurants = $data['restaurants'];
        $value = 1;
        foreach ($totalPointlist as $restaurant) {
            $restaurants[$restaurant['key']]['order'] = $restaurant['order'];
            $restaurant = $restaurants[$restaurant['key']];
            $generateDetail = GenerateDetailManager::mapExternal(
                [
                    'groupId' => $groupId,
                    'restaurantId' => $restaurant['id'],
                    'status' => Helper::STATUS_ACTIVE,
                    'regenerateStatus' => false,
                    'totalScore' => $restaurant['totalScore'],
                    'orderNo' => $restaurant['order'],
                    'data' => ''
                ]
            );

            $generateDetail = GenerateDetailManager::save($generateDetail);

            if ($value === 1) {
                $generate = GenerateManager::mapExternal(
                    [
                        'groupId' => $groupId,
                        'restaurantId' => $restaurant['id'],
                        'generateDetailId' => $generateDetail->id
                    ]
                );
                $generate = GenerateManager::save($generate);
            }
            $value++;
            
        }

        return $data;
    }

    private function map($group)
    {
        $data = [
            'id' => $group->getId(),
            'budget' => $group->getBudget(),
            'restaurants' => []
        ];

        foreach ($group->getRestaurants() as $restaurant) {
            $data['restaurants'][$restaurant->getId()] = [
                'id' => $restaurant->getId(),
                'averagePrice' => $restaurant->getAveragePrice() 
            ];
        }

        return $data;
    }

    private function insertionSort($restaurants)
    {
        $totalPointList = [];

        foreach ($restaurants as $restaurant) {
            $totalPointList[] = ['key' => $restaurant['id'], 'value' => $restaurant['totalScore']];
        }

        for ($i = 0; $i < count($totalPointList); $i++){           
            $value = $totalPointList[$i]['value'];
             $j = $i-1;
            while($j >= 0 && $totalPointList[$j]['value'] > $value){
                $totalPointList[$j+1]['value'] = $totalPointList[$j]['value'];
                $j--;
            }
            $totalPointList[$j+1]['value'] = $value;
            $totalPointList[$i]['order'] = $i + 1;
        }

        return $totalPointList;
    }
}