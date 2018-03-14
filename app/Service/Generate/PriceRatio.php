<?php

namespace App\Service\Generate;

class PriceRatio
{
    const NAME = 'priceRatioPoint';

    private $data;
    private $rate;
    private $restaurants;
    private $budget;

    public function __construct($data, $rate)
    {
        $this->data = $data;
        $this->rate = $rate;
        $this->restaurants = $this->data['restaurants'];
        $this->budget = $this->data['budget'];
    }

    public function handle()
    {
        foreach ($this->restaurants as $restaurant) {
            $ratio = $this->budget / $restaurant['averagePrice'];
            $total = $ratio * $this->rate;
            $this->restaurants[$restaurant['id']][self::NAME] = $total;
        }

        $this->data['restaurants'] = $this->restaurants;

        return $this->data;
    }
}