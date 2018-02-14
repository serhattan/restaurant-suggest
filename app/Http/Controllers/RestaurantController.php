<?php

namespace App\Http\Controllers;

use App\Models\RestaurantManager;

class RestaurantController extends Controller
{
    public function getList()
    {
        $restaurants = RestaurantManager::getAllRestaurantsOfUser();

        return view('pages.restaurant', ['datas' =>  $restaurants]);
    }

    public function saveAveragePrice()
    {

    }

}
