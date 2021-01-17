db.offers.aggregate([
    {'$match': {'$or': [
        {'promotion.public': true},
        {'promotion.hidden': false},
        // {'$in': ["5fff2da8a12dcb70344fa648", 'promotion.promoters']}
    ]}}
])

db.offers.aggregate([
    {
        '$unwind': {
            path: '$promotion.promoters',
            preserveNullAndEmptyArrays: true
        }
    },
    {
        '$match': {'$or': [
                {'promotion.public': true},
                {'promotion.hidden': false},
                {'$and': [{'promotion.hidden': false}, {'promotion.promoters': "5fff2da8a12dcb70344fa648"}]}
            ]
        }
    },
    {
        '$group': {
            '_id': {
                _id: '$_id',
                payout_type_ids: '$payout_type_ids',
                vertical_ids: '$vertical_ids',
                device_ids: '$device_ids',
                payout: '$payout',
            },
        }
    },
    {
        '$project': {_id: 1}
    }
])