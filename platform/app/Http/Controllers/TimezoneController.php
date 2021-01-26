<?php

namespace App\Http\Controllers;

use App\Models\Timezone;
use Illuminate\Http\Request;

class TimezoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->all === '1') {
            return Timezone::all();
        } else {
            return Timezone::where('name', 'like', '%' . ucfirst($request->q) . '%')
                ->orWhere('name', 'like', '%' . $request->q . '%')
                ->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function show(Timezone $timezone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function edit(Timezone $timezone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timezone $timezone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timezone $timezone)
    {
        //
    }
}