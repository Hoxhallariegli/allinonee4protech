<?php

namespace App\Livewire\Admin\WarehouseManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('WarehouseManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['categories'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\Category::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['customers'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\Customer::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['customerAddresses'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\CustomerAddress::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['employees'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\Employee::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['products'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\WarehouseManagement\Product::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['purchaseOrders'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\PurchaseOrder::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['sales'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\Sale::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['stockAdjustments'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\StockAdjustment::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['stockTransfers'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\StockTransfer::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['suppliers'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\Supplier::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['warehouses'] = collect(range(6, 0))->map(fn($i) => \App\Models\WarehouseManagement\Warehouse::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.warehouse-management.dashboard', [
            'stats' => [
            'categories' => \App\Models\WarehouseManagement\Category::count(),
            'customers' => \App\Models\WarehouseManagement\Customer::count(),
            'customerAddresses' => \App\Models\WarehouseManagement\CustomerAddress::count(),
            'employees' => \App\Models\WarehouseManagement\Employee::count(),
            'products' => \App\Models\WarehouseManagement\Product::count(),
            'products_sum' => (float) \App\Models\WarehouseManagement\Product::sum('price'),
            'purchaseOrders' => \App\Models\WarehouseManagement\PurchaseOrder::count(),
            'sales' => \App\Models\WarehouseManagement\Sale::count(),
            'stockAdjustments' => \App\Models\WarehouseManagement\StockAdjustment::count(),
            'stockTransfers' => \App\Models\WarehouseManagement\StockTransfer::count(),
            'suppliers' => \App\Models\WarehouseManagement\Supplier::count(),
            'warehouses' => \App\Models\WarehouseManagement\Warehouse::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}
