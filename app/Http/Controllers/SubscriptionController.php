<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\Mediatype;
use Illuminate\Http\Request; 
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Subscription::query();

        if ($request->has('search') && $request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
         }

        if ($request->has('sort')) {
             switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
             }
        }

        // Sortierlogik
        switch ($request->sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                    break;
        }

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $min = $request->input('min_price', 0);
            $max = $request->input('max_price', 100000);

            if ($request->filled('min_price') && !$request->filled('max_price')) {
                $query->where('price', '>=', $min);
            } elseif (!$request->filled('min_price') && $request->filled('max_price')) {
                $query->where('price', '<=', $max);
            } else {
                $query->whereBetween('price', [$min, $max]);
             }
        }
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'active':
                    $query->where('subscription_end', '>=', now());
                    break;
                case 'expired':
                    $query->where('subscription_end', '<', now());
                    break;
            }
        }
    
        $subs = $query->get();

        return view('subscriptions.index', [
            'subs' => $subs,
            'search' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mts = Mediatype::all();
        $billingcycles = \App\Models\Billingcycle::all();

        return view('subscriptions.create', compact('mts', 'billingcycles'));
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
        return view('subscriptions.edit', [
            'sub' => $subscription,
            'mts' => Mediatype::all(),
            'billingcycles' => \App\Models\Billingcycle::all()
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $validated = $request->validated();

        // Optional: sicherstellen, dass alle gewünschten Felder erlaubt sind
        $subscription->update($validated);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription wurde erfolgreich aktualisiert.');
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

    public function searchSuggestions(Request $request)
    {
    $term = $request->query('term');

    $results = Subscription::where('name', 'like', '%' . $term . '%')
        ->pluck('name')
        ->take(5); // Max. 5 Vorschläge

    return response()->json($results);
    }
    public function extend(Subscription $subscription)
    {
        $subscription->subscription_end = Carbon::parse($subscription->subscription_end)->addYear();
        $subscription->save();

        return redirect()->route('subscriptions.show', $subscription)
                        ->with('success', 'Abo wurde um 1 Jahr verlängert.');
    }

}
