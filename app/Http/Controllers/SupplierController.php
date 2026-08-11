<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display a listing of suppliers.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $suppliers = Supplier::withCount('assets')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('suppliers.index', compact('suppliers', 'search'));
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create(): View
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ], [
            'name.required' => 'Nama supplier wajib diisi.',
            'email.email' => 'Format email supplier tidak valid.',
        ]);

        Supplier::create($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier baru berhasil ditambahkan.');
    }

    /**
     * Display the specified supplier with related assets.
     */
    public function show(Supplier $supplier): View
    {
        $supplier->load(['assets' => function ($query) {
            $query->with(['category', 'location'])->latest();
        }]);

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit(Supplier $supplier): View
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ], [
            'name.required' => 'Nama supplier wajib diisi.',
            'email.email' => 'Format email supplier tidak valid.',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Data supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified supplier from storage securely.
     */
    public function destroy(Supplier $supplier): RedirectResponse
    {
        // Long-Term Safety Check: Prevent deletion if supplier has assets
        if ($supplier->assets()->count() > 0) {
            return redirect()->route('suppliers.index')
                ->with('error', "Gagal menghapus! Supplier '{$supplier->name}' masih terikat dengan {$supplier->assets()->count()} aset.");
        }

        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
