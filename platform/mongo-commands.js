db.offers.aggregate([
    {
        $match: {
            $or: [
                { "promotion.public": true },
                { "promotion.hidden": false },
                // {'$in': ["5fff2da8a12dcb70344fa648", 'promotion.promoters']}
            ],
        },
    },
]);

db.offers.aggregate([
    // {
    //     $unwind: {
    //         path: "$promotion.promoters",
    //         preserveNullAndEmptyArrays: true,
    //     },
    // },

    {
        $match: {
            $or: [
                { "promotion.public": true },

                {
                    $and: [
                        { "promotion.public": false },
                        {
                            $or: [
                                {
                                    "promotion.hidden": false,
                                },
                                {
                                    $and: [
                                        { "promotion.hidden": true },
                                        {
                                            "promotion.promoters":
                                                "5fff2da8a12dcb70344fa648",
                                        },
                                    ],
                                },
                            ],
                        },
                    ],
                },
            ],
        },
    },

    // {
    //     $group: {
    //         _id: {
    //             _id: "$_id",
    //             payout_type_ids: "$payout_type_ids",
    //             vertical_ids: "$vertical_ids",
    //             device_ids: "$device_ids",
    //             payout: "$payout",
    //         },
    //     },
    // },

    {
        $project: {
            _id: 1,
            name: 1,
            payout: 1,
            promotion: 1,
            restriction_ids: 1,
            promotion_method_ids: 1,
            niche_ids: 1,
            payout_type_ids: 1,
            vertical_ids: 1,
            device_ids: 1,
            os_ids: 1,
            browser_ids: 1,
            country_ids: 1,
        },
    },
]);

db.users.aggregate([
    {
        $sample: { size: 2 },
    },

    {
        $group: {
            _id: "$_id",
        },
    },
]);

db.clicks.aggregate([
    {
        $match: {
            converted: { $in: [true, false] },
            user_id: ObjectId("6016ba04f2c16a114b0e8f91"),
        },
    },

    {
        $lookup: {
            from: "offers",
            localField: "offer_id",
            foreignField: "_id",
            as: "offer",
        },
    },

    {
        $unwind: {
            path: "$offer",
            preserveNullAndEmptyArrays: false,
        },
    },

    {
        $replaceRoot: {
            newRoot: {
                _id: "$_id",
                offer_verticals: "$offer.vertical_ids",
            },
        },
    },

    {
        $unwind: {
            path: "$offer_verticals",
            preserveNullAndEmptyArrays: true,
        },
    },

    {
        $group: {
            _id: "$offer_verticals",
            count: { $sum: 1 },
        },
    },

    {
        $lookup: {
            from: "verticals",
            localField: "_id",
            foreignField: "_id",
            as: "vertical",
        },
    },

    {
        $unwind: {
            path: "$vertical",
            preserveNullAndEmptyArrays: false,
        },
    },

    {
        $replaceRoot: {
            newRoot: {
                _id: "$_id",
                count: "$count",
                vertical_name: "$vertical.name",
            },
        },
    },
]);
