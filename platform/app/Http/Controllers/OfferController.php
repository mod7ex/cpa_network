<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminOfferRequest;


class OfferController extends Controller
{
    use MongoHelper;

    
    public function __construct()
    {
        // $this->middleware('auth:admin,api')->only(['index', 'show']);

        // $this->middleware('auth:admin')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->adminOffers();
                    
        // if (Auth::guard('admin')->check() && auth('admin')->user()->can('viewAny', Offer::class)) {
        //     return $this->adminOffers();
        // } else if (Auth::guard('api')->check()) {
        //     return $this->userOffers();
        // }
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
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Offer::where('_id', $id)->first()->makeVisible('promotion', 'updated_at');

        // return $offer->makeVisible(['promotion']);

        // if (Auth::guard('admin')->check()) {

        //     $this->authorize('view', $offer);
        //     return $offer->makeVisible(['promotion']);
        // } else if (Auth::guard('api')->check()) {

        //     return $offer;
        // }
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