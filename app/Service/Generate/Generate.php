<?php

namespace App\Service\Generate;

use App\Models\DB\Group;
use App\Models\GroupManager;
use App\Models\GenerateManager;
use App\Models\GenerateDetailManager;
use App\Helpers\Helper;
use App\Models\Entity;

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

    /**
     * @param $groupId
     * @return mixed
     */
    public function handle($groupId)
    {
        $group = Group::with('restaurants')->where('id', $groupId)->first();
        $group = GroupManager::map($group);
        $data = $this->map($group);

        foreach (self::CLASSES as $class) {
            $model = new $class['name']($data, $class['rate']);
            $data = $model->handle();
        }

        $totalPointList = $this->insertionSort($data['restaurants']);
        $totalPointListCount = count($totalPointList);
        $restaurants = $data['restaurants'];
        $value = 0;
        $order = count($totalPointList);
        foreach ($totalPointList as $restaurant) {
            $restaurant = $restaurants[$restaurant['id']];
            $generateDetail = GenerateDetailManager::mapExternal([
                'groupId' => $groupId,
                'restaurantId' => $restaurant['id'],
                'status' => Helper::STATUS_ACTIVE,
                'regenerateStatus' => false,
                'totalScore' => $restaurant['totalScore'],
                'orderNo' => $order,
                'data' => ''
            ]);

            $generateDetail = GenerateDetailManager::save($generateDetail);
            $totalPointList[$value]['generateDetailId'] = $generateDetail->id;
            $totalPointList[$value]['orderNo'] = $generateDetail->order_no;

            $value++;
            $order--;
        }
        $generate = GenerateManager::mapExternal(
            [
                'groupId' => $groupId,
                'restaurantId' => $totalPointList[$totalPointListCount - 1]['id'],
                'generateDetailId' => $totalPointList[$totalPointListCount - 1]['generateDetailId'],
                'orderNo' => $totalPointList[$totalPointListCount - 1]['orderNo']
            ]
        );
        $generate = GenerateManager::save($generate);

        return $generate->id;
    }

    /**
     * @param Entity\Group $group
     * @return array
     */
    private function map(Entity\Group $group)
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

    /**
     * @param $restaurants
     * @return array
     */
    private function insertionSort($restaurants)
    {
        $totalPointList = [];

        foreach ($restaurants as $restaurant) {
            $totalPointList[] = ['id' => $restaurant['id'], 'value' => $restaurant['totalScore']];
        }

        for ($i = 0; $i < count($totalPointList); $i++) {
            $value = $totalPointList[$i]['value'];
            $id = $totalPointList[$i]['id'];
            $j = $i - 1;
            while ($j >= 0 && $totalPointList[$j]['value'] > $value) {
                $totalPointList[$j + 1]['value'] = $totalPointList[$j]['value'];
                $totalPointList[$j + 1]['id'] = $totalPointList[$j]['id'];
                $j--;
            }
            $totalPointList[$j + 1]['value'] = $value;
            $totalPointList[$j + 1]['id'] = $id;
        }

        return $totalPointList;
    }
}