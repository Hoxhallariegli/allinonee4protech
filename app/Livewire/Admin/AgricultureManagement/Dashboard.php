<?php

namespace App\Livewire\Admin\AgricultureManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\AgricultureManagement\Field;
use App\Models\AgricultureManagement\Crop;
use App\Models\AgricultureManagement\InventorySupply;
use Illuminate\Support\Facades\DB;

#[Title('Agriculture Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_fields' => Field::count(),
            'total_crops' => Crop::count(),
            'growing_crops' => Crop::where('status', 'growing')->count(),
            'low_stock_supplies' => InventorySupply::where('stock_quantity', '<', 100)->count(),
        ];

        $cropsByStatus = Crop::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $recentCrops = Crop::with('field')->latest()->take(5)->get();

        return view('livewire.admin.agriculture-management.dashboard', [
            'stats' => $stats,
            'cropsByStatus' => $cropsByStatus,
            'recentCrops' => $recentCrops,
        ])->layout('components.layouts.app');
    }
}
