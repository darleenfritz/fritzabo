<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\Mediatype;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subs = Subscription::all();
        return view('subscriptions.index', ['subs' => $subs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        //
        $validated = $request->validated();
        $subscription = new Subscription($validated);
        $subscription->save();
        return redirect ( route('subscriptions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
        return view('subscriptions.show', ['sub' => $subscription]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
        return view('subscriptions.edit', ['sub' => $subscription, 'mts' => Mediatype::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
        $validated = $request->validated();
        $subscription->update($validated);
        return redirect()->back()->with('message','Hat geklappt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
        $subscription->delete();

    return redirect()->route('subscriptions.index')
                     ->with('success', 'Subscription gelöscht!');
    }
}
