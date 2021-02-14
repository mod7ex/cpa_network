<?php

namespace App\Http\Controllers\Admins;

use Carbon\Carbon;
use App\Models\Click;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    private function dayStat($today = true){

        $created_at = array(
            '$gte' => $this->mongoDate($today ? Carbon::today() : Carbon::yesterday())
        );

        if(!$today) {
            $created_at['$lt'] = $this->mongoDate(Carbon::today());
        }

        return Click::raw(function($collection) use ($created_at) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'created_at' => $created_at
                    ]
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
                            'converted' => '$converted',
                            'hour' => ['$hour' => '$created_at'],
                            'earning' => ['$multiply' => [ '$offer.payout', ['$toInt' => '$converted'] ]],
                        ],
                    ],
                ],

                [
                    '$group' => [
                        '_id' => [
                            'hour' => '$hour',
                            'converted' => '$converted'
                        ],
                        'count' => ['$sum' => 1],
                        'earnings' => ['$sum' => '$earning'],
                    ]
                ],
                
                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            'converted' => '$_id.converted',
                            'hour' => '$_id.hour',
                            'count' => '$count',
                            'earnings' => '$earnings',
                        ],
                    ],
                ],
            ]);
        });
    }
    
    public function today()
    {
        return [
            'today' => $this->dayStat(),
            'yesterday' => $this->dayStat(false),
        ];
    }

    public function topOffers()
    {
        $today = Carbon::parse(Carbon::today())->dayOfWeek + 1;

        $match = array(
            'created_at' => ['$gte' => $this->mongoDate(Carbon::yesterday())]
        );

        return Click::raw(function($collection) use ($match, $today) {
            return $collection->aggregate([
                [
                    '$match' => $match
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
                            'converted' => '$converted',
                            'today' => ['$in' => [['$dayOfWeek' => '$created_at'], [ $today ]]],
                            'offer' => [
                                '_id' => '$offer_id',
                                'name' => '$offer.name',
                                'payout' => '$offer.payout',
                            ],
                        ],
                    ],
                ],

                [
                    '$group' => [
                        '_id' => [
                            'offer' => '$offer',
                        ],

                        'clicks' => ['$sum' => ['$toInt' => '$today']],
                        'today_conversions' => ['$sum' => ['$multiply' => [ ['$toInt' => '$today'], ['$toInt' => '$converted'] ]]],
                        'yesterday_conversions' => [
                            '$sum' => [
                                '$multiply' => [
                                    ['$toInt' => '$converted'],
                                    [
                                        '$mod' => [['$add' => [['$toInt' => '$today'], 1]], 2]
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],

                [
                    '$sort' => [ 'today_conversions' => -1 ]
                ],

                [
                    '$limit' => 5
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            'offer' => '$_id.offer',
                            'clicks' => '$clicks',
                            'today_conversions' => '$today_conversions',
                            'yesterday_conversions' => '$yesterday_conversions',
                        ],
                    ],
                ],

            ]);
        });
    }

    public function topUsers()
    {
        $today = Carbon::parse(Carbon::today())->dayOfWeek + 1;

        $match = array(
            'created_at' => ['$gte' => $this->mongoDate(Carbon::yesterday())]
        );

        return Click::raw(function($collection) use ($match, $today) {
            return $collection->aggregate([
                [
                    '$match' => $match
                ],

                [
                    '$addFields' => [
                        "usr_id" => ['$toObjectId' => '$user_id' ]
                    ]
                ],

                [
                    '$addFields' => [
                        "off_id" => ['$toObjectId' => '$offer_id' ]
                    ]
                ],

                [
                    '$lookup' => [
                        'from' => 'users',
                        'localField' => 'usr_id',
                        'foreignField' => '_id',
                        'as' => 'user',
                    ],
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
                        'path' => '$user',
                        'preserveNullAndEmptyArrays' => false,
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
                            'converted' => '$converted',
                            'today' => ['$in' => [['$dayOfWeek' => '$created_at'], [ $today ]]],
                            'earning' => ['$multiply' => [ '$offer.payout', ['$toInt' => '$converted'] ]],
                            'user' => [
                                '_id' => '$user_id',
                                'first_name' => '$user.contact_infos.first_name',
                                'last_name' => '$user.contact_infos.last_name',
                            ],
                        ],
                    ],
                ],

                [
                    '$group' => [
                        '_id' => [
                            'user' => '$user'
                        ],
                        'clicks' => ['$sum' => ['$toInt' => '$today']],

                        'conversions' => ['$sum' => ['$multiply' => [ ['$toInt' => '$converted'], ['$toInt' => '$today']]]],
                        
                        'today_earnings' => ['$sum' => ['$multiply' => [ '$earning', ['$toInt' => '$today'] ]]],

                        'yesterday_earnings' => [
                            '$sum' => [
                                '$multiply' => [
                                    '$earning', [
                                        '$mod' => [['$add' => [['$toInt' => '$today'], 1]], 2]
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],

                [
                    '$sort' => ['today_earnings' => -1]
                ],

                [
                    '$limit' => 5
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            'user' => '$_id.user',
                            'clicks' => '$clicks',
                            'conversions' => '$conversions',
                            'today_earnings' => '$today_earnings',
                            'yesterday_earnings' => '$yesterday_earnings',
                        ]
                    ],
                ],

            ]);

        });
    }
}