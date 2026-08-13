<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AssetController extends Controller
{
    /**
     * Display a listing of assets with search & filters.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        $supplierId = $request->input('supplier_id');
        $locationId = $request->input('location_id');
        $condition = $request->input('condition');
        $status = $request->input('status');

        $assets = Asset::with(['category', 'supplier', 'location'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('asset_code', 'like', "%{$search}%")
                      ->orWhere('asset_name', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($supplierId, function ($query, $supplierId) {
                $query->where('supplier_id', $supplierId);
            })
            ->when($locationId, function ($query, $locationId) {
                $query->where('location_id', $locationId);
            })
            ->when($condition, function ($query, $condition) {
                $query->where('condition', $condition);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        return view('assets.index', compact(
            'assets',
            'categories',
            'suppliers',
            'locations',
            'search',
            'categoryId',
            'supplierId',
            'locationId',
            'condition',
            'status'
        ));
    }

    /**
     * Show the form for creating a new asset.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        // Auto-generate suggested asset code: AST-YYYYMM-XXXX
        $suggestedCode = 'AST-' . date('Ym') . '-' . str_pad((Asset::max('id') + 1), 4, '0', STR_PAD_LEFT);

        return view('assets.create', compact('categories', 'suppliers', 'locations', 'suggestedCode'));
    }

    /**
     * Store a newly created asset in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Sanitize purchase_price input (remove "Rp", dots, spaces if formatted)
        if ($request->has('purchase_price') && is_string($request->purchase_price)) {
            $cleanedPrice = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $request->purchase_price));
            $request->merge(['purchase_price' => $cleanedPrice ?: null]);
        }

        $validated = $request->validate([
            'asset_code' => 'required|string|max:100|unique:assets,asset_code',
            'asset_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'location_id' => 'required|exists:locations,id',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'condition' => ['required', Rule::in(['Baik', 'Rusak'])],
            'status' => ['required', Rule::in(['Tersedia', 'Dipakai'])],
        ], [
            'asset_code.required' => 'Kode aset wajib diisi.',
            'asset_code.unique' => 'Kode aset ini sudah digunakan. Silakan gunakan kode unik lain.',
            'asset_name.required' => 'Nama aset wajib diisi.',
            'category_id.required' => 'Kategori aset wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'supplier_id.required' => 'Supplier aset wajib dipilih.',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid.',
            'location_id.required' => 'Lokasi penempatan aset wajib dipilih.',
            'location_id.exists' => 'Lokasi yang dipilih tidak valid.',
            'condition.required' => 'Kondisi aset wajib dipilih.',
            'status.required' => 'Status aset wajib dipilih.',
        ]);

        Asset::create($validated);

        return redirect()->route('assets.index')
            ->with('success', 'Aset baru berhasil ditambahkan.');
    }

    /**
     * Display the specified asset details.
     */
    public function show(Asset $asset): View
    {
        $asset->load(['category', 'supplier', 'location']);

        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified asset.
     */
    public function edit(Asset $asset): View
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        return view('assets.edit', compact('asset', 'categories', 'suppliers', 'locations'));
    }

    /**
     * Update the specified asset in storage securely.
     */
    public function update(Request $request, Asset $asset): RedirectResponse
    {
        // Sanitize purchase_price input
        if ($request->has('purchase_price') && is_string($request->purchase_price)) {
            $cleanedPrice = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $request->purchase_price));
            $request->merge(['purchase_price' => $cleanedPrice ?: null]);
        }

        $validated = $request->validate([
            'asset_code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('assets', 'asset_code')->ignore($asset->id),
            ],
            'asset_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'location_id' => 'required|exists:locations,id',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'condition' => ['required', Rule::in(['Baik', 'Rusak'])],
            'status' => ['required', Rule::in(['Tersedia', 'Dipakai'])],
        ], [
            'asset_code.required' => 'Kode aset wajib diisi.',
            'asset_code.unique' => 'Kode aset sudah digunakan oleh aset lain.',
            'asset_name.required' => 'Nama aset wajib diisi.',
            'category_id.required' => 'Kategori aset wajib dipilih.',
            'supplier_id.required' => 'Supplier aset wajib dipilih.',
            'location_id.required' => 'Lokasi penempatan aset wajib dipilih.',
            'condition.required' => 'Kondisi aset wajib dipilih.',
            'status.required' => 'Status aset wajib dipilih.',
        ]);

        $asset->update($validated);

        return redirect()->route('assets.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    /**
     * Remove the specified asset from storage.
     */
    public function destroy(Asset $asset): RedirectResponse
    {
        $code = $asset->asset_code;
        $asset->delete();

        return redirect()->route('assets.index')
            ->with('success', "Aset '{$code}' berhasil dihapus dari sistem.");
    }
}
