<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billingcycle;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BillingcycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Billingcycle::query()->with('subscriptions');

        if ($request->has('search') && $request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        }

        $billingcycles = $query->get();

        return view('billingcycles.index', compact('billingcycles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('billingcycles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'interval_in_days' => 'required|integer|min:1'
        ]);

        Billingcycle::create($validated);

        return redirect()->route('billingcycles.index')->with('success', 'Abrechnungszyklus hinzugefügt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Billingcycle $billingcycle)
    {
        return view('billingcycles.show', compact('billingcycle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billingcycle $billingcycle)
    {
        return view('billingcycles.edit', compact('billingcycle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billingcycle $billingcycle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'interval_in_days' => 'required|integer|min:1'
        ]);

        $billingcycle->update($validated);

        return redirect()->route('billingcycles.index')->with('success', 'Abrechnungszyklus aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billingcycle $billingcycle)
    {
        $billingcycle->delete();
        return redirect()->route('billingcycles.index')->with('success', 'Abrechnungszyklus gelöscht.');
    }

    public function export(Billingcycle $billingcycle): StreamedResponse
    {
        $filename = 'billingcycle_' . $billingcycle->id . '_export.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($billingcycle) {
            $handle = fopen('php://output', 'w');

            // Kopfzeile
            fputcsv($handle, ['ID', 'Name', 'Intervall (Tage)', 'Angelegt am']);

            // Datenzeile
            fputcsv($handle, [
                $billingcycle->id,
                $billingcycle->name,
                $billingcycle->interval_in_days,
                $billingcycle->created_at->format('d.m.Y H:i'),
            ]);

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
