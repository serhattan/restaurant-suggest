<?php

namespace App\Service\Generate;

class RegenerateScore
{
    const NAME = 'regenerateScore';

    private $data;
    private $rate;
    private $restaurants;

    public function __construct($data, $rate)
    {
        $this->data = $data;
        $this->rate = $rate;
        $this->restaurants = $this->data['restaurants'];
    }

    public function handle()
    {
        foreach ($this->restaurants as $restaurant) {
            if (round(count($this->restaurants)/2) > $restaurant['regenerateCount']) {
                $this->restaurants[$restaurant['id']][self::NAME] = $restaurant['regenerateCount'] * $this->rate * 2;                
            } else {
                $this->restaurants[$restaurant['id']][self::NAME] = $restaurant['regenerateCount'] * $this->rate;
            }
        }

        $this->data['restaurants'] = $this->restaurants;

        return $this->data;
    }
}