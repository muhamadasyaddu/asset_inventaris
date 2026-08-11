<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    /**
     * Display a listing of locations.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $locations = Location::withCount('assets')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('locations.index', compact('locations', 'search'));
    }

    /**
     * Show the form for creating a new location.
     */
    public function create(): View
    {
        return view('locations.create');
    }

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama lokasi wajib diisi.',
            'name.max' => 'Nama lokasi maksimal 255 karakter.',
        ]);

        Location::create($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Lokasi baru berhasil ditambahkan.');
    }

    /**
     * Display the specified location with related assets.
     */
    public function show(Location $location): View
    {
        $location->load(['assets' => function ($query) {
            $query->with(['category', 'supplier'])->latest();
        }]);

        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit(Location $location): View
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     */
    public function update(Request $request, Location $location): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama lokasi wajib diisi.',
            'name.max' => 'Nama lokasi maksimal 255 karakter.',
        ]);

        $location->update($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Data lokasi berhasil diperbarui.');
    }

    /**
     * Remove the specified location from storage securely.
     */
    public function destroy(Location $location): RedirectResponse
    {
        // Long-Term Safety Check: Prevent deletion if location has assets
        if ($location->assets()->count() > 0) {
            return redirect()->route('locations.index')
                ->with('error', "Gagal menghapus! Lokasi '{$location->name}' masih memiliki {$location->assets()->count()} aset terikat.");
        }

        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Lokasi berhasil dihapus.');
    }
}
