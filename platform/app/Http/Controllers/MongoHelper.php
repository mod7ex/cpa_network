<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;


Trait MongoHelper
{
    protected function usersListing()
    {
        return User::raw(function($collection){
            return $collection->aggregate([
                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            '_id' => '$_id',
                            'active' => '$active',
                            'name' => ['$concat' => ['$contact_infos.first_name', ' ', '$contact_infos.last_name']],
                            'email' => '$email',
                            'country_id' => '$contact_infos.country_id',
                            'balance' => '$balance'
                        ]
                    ]
                ],
               
                [
                    '$addFields' => [
                        "ct_id" => ['$toObjectId' => '$country_id' ]
                    ]
                ],

                [
                    '$lookup' => [
                        'from' => 'countries',
                        'localField' => 'ct_id',
                        'foreignField' => '_id',
                        'as' => 'country',
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$country',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            '_id' => '$_id',
                            'active' => '$active',
                            'name' => '$name',
                            'email' => '$email',
                            'balance' => '$balance',
                            'country' => ['$concat' => ['$country.details.name', ' ', '$country.details.code']],
                        ]
                    ]
                ],
            ]);
        });
    }

    protected function userOffers(){
        return Offer::all();

    }

    protected function adminOffers(){
        return Offer::raw(function($collection){
            return $collection->aggregate([
                [
                    '$project' => [
                        'name' => 1,
                        'payout' => 1,
                        'country_ids' => 1,
                        'payout_type_ids' => 1,
                        'vertical_ids' => 1,
                    ]
                ],

                [
                    '$unwind' => [
                        'path' => '$country_ids',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$payout_type_ids',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$vertical_ids',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$addFields' => [
                        "ct_id" => ['$toObjectId' => '$country_ids' ],
                        "pt_id" => ['$toObjectId' => '$payout_type_ids' ],
                        "v_id" => ['$toObjectId' => '$vertical_ids' ],
                    ]
                ],

                [
                    '$lookup' => [
                        'from' => 'countries',
                        'localField' => 'ct_id',
                        'foreignField' => '_id',
                        'as' => 'country',
                    ],
                ],

                [
                    '$lookup' => [
                        'from' => 'payout_types',
                        'localField' => 'pt_id',
                        'foreignField' => '_id',
                        'as' => 'payout_type',
                    ],
                ],

                [
                    '$lookup' => [
                        'from' => 'verticals',
                        'localField' => 'v_id',
                        'foreignField' => '_id',
                        'as' => 'vertical',
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$payout_type',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$country',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$unwind' => [
                        'path' => '$vertical',
                        'preserveNullAndEmptyArrays' => false,
                    ],
                ],

                [
                    '$group' => [
                        '_id' => [
                            // '_id' => '$_id',
                            '_id' => ['$toString' => '$_id'],
                            'name' => '$name',
                            'payout' => '$payout',
                        ],

                        'countries' => [
                            '$addToSet' => '$country.details.code'
                        ],

                        'payout_types' => [
                            '$addToSet' => '$payout_type.name'
                        ],

                        'verticals' => [
                            '$addToSet' => '$vertical.name'
                        ]
                    ]
                ],

                [
                    '$replaceRoot' => [
                        'newRoot' => [
                            '_id' => '$_id._id',
                            'name' => '$_id.name',
                            'payout' => '$_id.payout',
                            'countries' => '$countries',
                            'payout_types' => '$payout_types',
                            'verticals' => '$verticals',
                        ]
                    ]
                ]
            ]);
        });
    }
}