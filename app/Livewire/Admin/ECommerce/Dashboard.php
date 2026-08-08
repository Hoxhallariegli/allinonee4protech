<?php

namespace App\Livewire\Admin\ECommerce;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('ECommerce Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['customers'] = collect(range(6, 0))->map(fn($i) => \App\Models\ECommerce\Customer::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['orders'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\ECommerce\Order::whereDate('created_at', now()->subDays($i))->sum('total'))->toArray();
        $chartData['orderItems'] = collect(range(6, 0))->map(fn($i) => \App\Models\ECommerce\OrderItem::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['products'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\ECommerce\Product::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['vendors'] = collect(range(6, 0))->map(fn($i) => \App\Models\ECommerce\Vendor::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.e--commerce.dashboard', [
            'stats' => [
            'customers' => \App\Models\ECommerce\Customer::count(),
            'orders' => \App\Models\ECommerce\Order::count(),
            'orders_sum' => (float) \App\Models\ECommerce\Order::sum('total'),
            'orderItems' => \App\Models\ECommerce\OrderItem::count(),
            'products' => \App\Models\ECommerce\Product::count(),
            'products_sum' => (float) \App\Models\ECommerce\Product::sum('price'),
            'vendors' => \App\Models\ECommerce\Vendor::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}