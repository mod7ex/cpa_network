<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use MongoHelper;


    public function __construct()
    {
        // $this->middleware('auth:admin')->except(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->usersListing();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', User::class);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $this->authorize('view', $user);

        return User::where('_id', $id)->with('paymentmethod')->with('country')->with('timezone')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // $this->authorize('update', $user);

        $user->update([
            'contact_infos' => Arr::only($request->validated(), [
                'first_name',
                'last_name',
                'website',
                'country_id',
                'street_address',
                'city',
                'region',
                'zip_code',
                'phone_number',
                'skype',
                'telegram',
                'title',
                'timezone_id',
                'best_time_to_call',
            ]),


            'billing_infos' => Arr::only($request->validated(), [
                'payment_method_id',
                'min_payout',
                'billing_details',
            ]),

            'password' => Hash::make(Arr::get($request->validated(), 'password')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $this->authorize('delete', $user);

        $user->delete();
    }
}