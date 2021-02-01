<?php

namespace Database\Factories;


Trait FactoryHelper
{
    protected function getRandomIds($class, $k = 1){

        return $class::raw(function ($collection) use ($k) {

            return $collection->aggregate([
                [
                    '$sample' => ['size' => $k]
                ],

                [
                    '$project' => ['_id' => 1],
                ]
            ]);

        })->map(function($item){

            return $item->_id;

        })->toArray();
    }


    protected function getRandomRecords($class, $k = 1){

        return $class::raw(function ($collection) use ($k) {

            return $collection->aggregate([
                [
                    '$sample' => ['size' => $k]
                ]
            ]);

        });
    }

    protected function getRandom($class, $justId = true){
        if($justId){
            return $this->getRandomIds($class)[0];
        }else{
            return $this->getRandomRecords($class)->first();
        }
    }
}