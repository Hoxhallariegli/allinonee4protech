<?php

namespace App\Livewire\Admin\PharmacyManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('PharmacyManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['medicines'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\PharmacyManagement\Medicine::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['prescriptions'] = collect(range(6, 0))->map(fn($i) => \App\Models\PharmacyManagement\Prescription::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['prescriptionItems'] = collect(range(6, 0))->map(fn($i) => \App\Models\PharmacyManagement\PrescriptionItem::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['sales'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\PharmacyManagement\Sale::whereDate('created_at', now()->subDays($i))->sum('total'))->toArray();
        $chartData['suppliers'] = collect(range(6, 0))->map(fn($i) => \App\Models\PharmacyManagement\Supplier::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.pharmacy-management.dashboard', [
            'stats' => [
            'medicines' => \App\Models\PharmacyManagement\Medicine::count(),
            'medicines_sum' => (float) \App\Models\PharmacyManagement\Medicine::sum('price'),
            'prescriptions' => \App\Models\PharmacyManagement\Prescription::count(),
            'prescriptionItems' => \App\Models\PharmacyManagement\PrescriptionItem::count(),
            'sales' => \App\Models\PharmacyManagement\Sale::count(),
            'sales_sum' => (float) \App\Models\PharmacyManagement\Sale::sum('total'),
            'suppliers' => \App\Models\PharmacyManagement\Supplier::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}