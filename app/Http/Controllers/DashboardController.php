<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the inventory dashboard summary.
     */
    public function index(): View
    {
        $totalAssets = Asset::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalLocations = Location::count();

        $totalValue = Asset::sum('purchase_price') ?? 0;

        $conditionBaikCount = Asset::where('condition', 'Baik')->count();
        $conditionRusakCount = Asset::where('condition', 'Rusak')->count();

        $statusTersediaCount = Asset::where('status', 'Tersedia')->count();
        $statusDipakaiCount = Asset::where('status', 'Dipakai')->count();

        $recentAssets = Asset::with(['category', 'supplier', 'location'])
            ->latest()
            ->take(5)
            ->get();

        $categoriesSummary = Category::withCount('assets')->get();
        $locationsSummary = Location::withCount('assets')->get();

        return view('dashboard', compact(
            'totalAssets',
            'totalCategories',
            'totalSuppliers',
            'totalLocations',
            'totalValue',
            'conditionBaikCount',
            'conditionRusakCount',
            'statusTersediaCount',
            'statusDipakaiCount',
            'recentAssets',
            'categoriesSummary',
            'locationsSummary'
        ));
    }
}
