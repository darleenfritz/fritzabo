<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mediatype;
use Illuminate\Support\Facades\Response;

class MediatypeController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $sort = $request->input('sort');
    $view = $request->input('view', 'grid'); // default: grid

    $query = Mediatype::with('subscriptions');

    // Suche
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    // Sortierung
    if ($sort === 'name_asc') {
        $query->orderBy('name', 'asc');
    } elseif ($sort === 'name_desc') {
        $query->orderBy('name', 'desc');
    }

    $mts = $query->get();

    return view('mediatypes.index', [
        'mts' => $mts,
        'search' => $search,
        'sort' => $sort,
        'view' => $view
    ]);
}

    public function create()
    {
        return view('mediatypes.create');
    }

    public function store(Request $request)
    {
        $mt = new Mediatype();
        $mt->name = $request['name'];
        $mt->save();
        return redirect()->route('mediatypes.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $mediatype = Mediatype::findOrFail($id);
        return view('mediatypes.edit', compact('mediatype'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $mediatype = Mediatype::findOrFail($id);
        $mediatype->name = $request->input('name');
        $mediatype->save();

        return redirect()->route('mediatypes.index')->with('success', 'Medientyp erfolgreich aktualisiert');
    }

    public function destroy(string $id)
    {
        $mediatype = Mediatype::findOrFail($id);
        $mediatype->delete();

        return redirect()->route('mediatypes.index')->with('success', 'Medientyp gelöscht');
    }

    public function export($id)
    {
        $mediatype = Mediatype::with('subscriptions')->findOrFail($id);

        $filename = 'subscriptions_' . $mediatype->name . '.csv';
        $headers = ['Content-Type' => 'text/csv'];

        $callback = function() use ($mediatype) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Kontakt', 'Preis', 'Start', 'Ende']);

            foreach ($mediatype->subscriptions as $sub) {
                fputcsv($handle, [
                    $sub->id,
                    $sub->name,
                    $sub->contact,
                    $sub->price,
                    $sub->subscribed_at,
                    $sub->subscription_end
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, array_merge($headers, [
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]));
    }
}
