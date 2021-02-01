<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function today()
    {
        return Click::select('created_at', 'converted')
                    ->where('created_at','>', Carbon::today())
                    ->get()
                    ->makeVisible(['created_at']);
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function filtered(Request $request)
    {
        /**
         * 
         * preparing the $match
         * 
         */
        $match = array(
            'user_id' => auth('api')->user()->id,

            'created_at' => [
                '$gte' => $this->mongoDate($request->from),
                '$lte' => $this->mongoDate($request->to)
            ],

            'converted' => ['$in' => [true, filter_var($request->by, FILTER_VALIDATE_BOOL)]]
        );

        foreach(['os', 'browser', 'device', 'country'] as $item){
            if($request->$item){
                $match['details.' . $item] = $this->mongoId($request->$item);
            }
        }


        return Click::raw(function($collection) use ($match) {

            return $collection->aggregate([
                [
                    '$match' => $match
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            // '_id' => '$_id',
                            'created_at' => '$created_at',
                        ],
                    ],
                ],
            ]);

        })->map(function($item){
            //   return Carbon::parse($item->created_at)->hour;
            //   return Carbon::parse($item->created_at)->day;
            //   return Carbon::parse($item->created_at)->year;
            //   return Carbon::parse($item->created_at)->month;
            return $item->created_at;
          });
    }

    

    /**
     * @param Request $request
     * 
     * @return Array
     */
    public function donut(Request $request)
    {
        /* 
            filter
              ->  vertical ** 
              ->  niche
        */


        return Click::raw(function($collection) use ($request) {

            return $collection->aggregate([
                [
                    '$match' => [
                        'user_id' => auth('api')->user()->id,

                        'created_at' => [
                            '$gte' => $this->mongoDate($request->from),
                            '$lte' => $this->mongoDate($request->to)
                        ],

                        'converted' => ['$in' => [true, filter_var($request->by, FILTER_VALIDATE_BOOL)]]
                    ],
                ],

                [
                    '$addFields' => [
                        "off_id" => ['$toObjectId' => '$offer_id' ]
                    ]
                ],

                [
                    '$lookup' => [
                        'from' => 'offers',
                        'localField' => 'off_id',
                        'foreignField' => '_id',
                        'as' => 'offer',
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$offer',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            '_id' => '$_id',
                            'offer_' . $request->filter . 's' => '$offer.' . $request->filter . '_ids',
                        ],
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$offer_' . $request->filter . 's',
                        'preserveNullAndEmptyArrays' => true,
                    ],
                ],

                [
                    '$group' => [
                        '_id' => '$offer_' . $request->filter . 's',
                        'count' => [ '$sum' => 1 ],
                    ],
                ],

                [
                    '$addFields' => [
                        $request->filter . '_id' => ['$toObjectId' => '$_id' ]
                    ]
                ],

                [
                    '$lookup' => [
                        'from' => $request->filter . 's',
                        'localField' => $request->filter . '_id',
                        'foreignField' => '_id',
                        'as' => $request->filter,
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$' . $request->filter,
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            'count' => '$count',
                            '' . $request->filter . '_name' => '$' . $request->filter . '.name',
                        ],
                    ],
                ],
            ]);

        });
    }
}