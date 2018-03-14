<?php

namespace App\Service\Generate;

class TotalScore
{
    const NAME = 'totalScore';

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
            $total = $restaurant['priceRatioPoint'];
            $this->restaurants[$restaurant['id']][self::NAME] = $total;
        }

        $this->data['restaurants'] = $this->restaurants;

        return $this->data;
    }
}