<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function today()
    {
        $match = array(
            'user_id' => auth('api')->user()->id,

            'created_at' => [
                '$gte' => $this->mongoDate(Carbon::today())
            ],
        );

        return Click::raw(function($collection) use ($match) {
            return $collection->aggregate([
                [
                    '$match' => $match
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            '_id' => '$_id',
                            'converted' => '$converted',
                            'hour' => ['$hour' => '$created_at'],
                        ],
                    ],
                ],

                [
                    '$group' => [
                        '_id' => [
                            'hour' => '$hour',
                            'converted' => '$converted'
                        ],
                        'count' => ['$sum' => 1]
                    ]
                ],
                
                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            'converted' => '$_id.converted',
                            'hour' => '$_id.hour',
                            'count' => '$count',
                        ],
                    ],
                ],
            ]);
        });
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
                $match['details.' . $item] = $request->$item;
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
                            '_id' => '$_id',
                            'hour' => ['$hour' => '$created_at'],
                            'dayOfMonth' => ['$dayOfMonth' => '$created_at'],
                            'month' => ['$month' => '$created_at'],
                            'year' => ['$year' => '$created_at'],
                        ],
                    ],
                ],

                [
                    '$group' => [
                        '_id' => [
                            'hour' => '$hour',
                            'day' => '$dayOfMonth',
                            'month' => '$month',
                            'year' => '$year',
                        ],
                        'count' => ['$sum' => 1]
                    ]
                    ],

                    [
                    '$replaceRoot' => [
                        'newRoot' => [
                            'hour' => '$_id.hour',
                            'day' => '$_id.day',
                            'month' => '$_id.month',
                            'year' => '$_id.year',
                            'count' => '$count',
                        ],
                    ],
                ],
            ]);

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
