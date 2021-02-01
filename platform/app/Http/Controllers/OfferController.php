<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminOfferRequest;


class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,api')->only(['index', 'show']);

        $this->middleware('auth:admin')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {

            $this->authorize('viewAny', Offer::class);

            return Offer::all()->makeVisible(['promotion']);
        } else if (Auth::guard('api')->check()) {

            return Offer::raw(function ($collection) {
                return $collection->aggregate([
                    // [
                    //     '$unwind' => 
                    //         [
                    //         'path' => "promotion.promoters",
                    //         'preserveNullAndEmptyArrays' => true
                    //     ]
                    // ],

                    // [
                    //     '$match' => [ '$or' => [

                    //             [ "promotion.public" => true ],

                    //             [
                    //                 '$and' => [
                    //                     [ "promotion.public" => false ],

                    //                     [
                    //                         '$or' => [
                    //                             [
                    //                                 "promotion.hidden" => false,
                    //                             ],
                                                
                    //                             [
                    //                                 '$and' => [
                    //                                     [ "promotion.hidden" => true ],

                    //                                     [
                    //                                         "promotion.promoters" =>
                    //                                             auth()->user()->id,
                    //                                     ],
                    //                                 ],
                    //                             ],
                    //                         ],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ]
                    // ],

                    [
                        '$project' => [
                            // '_id' =>  1,
                            // 'name' =>  1,
                            // 'payout' =>  1,
                            // 'promotion' =>  1,
                            // 'restriction_ids' =>  1,
                            // 'promotion_method_ids' =>  1,
                            // 'niche_ids' =>  1,
                            // 'payout_type_ids' =>  1,
                            // 'vertical_ids' =>  1,
                            // 'device_ids' =>  1,
                            // 'os_ids' =>  1,
                            // 'browser_ids' =>  1,


                            'description' =>  0,
                            'images' =>  0,
                            'landing_pages' =>  0,
                        ],
                    ],
                ]);
            });
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AdminOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminOfferRequest $request)
    {
        $this->authorize('create', Offer::class);

        Offer::create($request->validated());

        return response()->json(['message' => 'offer created successfully', 'success' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {

        if (Auth::guard('admin')->check()) {
            
            $this->authorize('view', $offer);
            return $offer->makeVisible(['promotion']);
        } else if (Auth::guard('api')->check()) {

            return $offer;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(AdminOfferRequest $request, Offer $offer)
    {
        $this->authorize('update', $offer);

        $offer->update($request->validated());

        return response()->json(['message' => 'offer updated successfully', 'success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $this->authorize('delete', $offer);

        $offer->delete();

        return response()->json(['message' => 'offer deleted successfully', 'success' => true]);
    }
}