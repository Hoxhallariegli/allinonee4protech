<?php

namespace App\Livewire\Admin\RestaurantPOS;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('RestaurantPOS Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['categories'] = collect(range(6, 0))->map(fn($i) => \App\Models\RestaurantPOS\Category::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['diningTables'] = collect(range(6, 0))->map(fn($i) => \App\Models\RestaurantPOS\DiningTable::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['ingredients'] = collect(range(6, 0))->map(fn($i) => \App\Models\RestaurantPOS\Ingredient::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['menuItems'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\RestaurantPOS\MenuItem::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['orders'] = collect(range(6, 0))->map(fn($i) => \App\Models\RestaurantPOS\Order::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['orderItems'] = collect(range(6, 0))->map(fn($i) => \App\Models\RestaurantPOS\OrderItem::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['payments'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\RestaurantPOS\Payment::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['recipes'] = collect(range(6, 0))->map(fn($i) => \App\Models\RestaurantPOS\Recipe::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['waiters'] = collect(range(6, 0))->map(fn($i) => \App\Models\RestaurantPOS\Waiter::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.restaurant-p-o-s.dashboard', [
            'stats' => [
            'categories' => \App\Models\RestaurantPOS\Category::count(),
            'diningTables' => \App\Models\RestaurantPOS\DiningTable::count(),
            'ingredients' => \App\Models\RestaurantPOS\Ingredient::count(),
            'menuItems' => \App\Models\RestaurantPOS\MenuItem::count(),
            'menuItems_sum' => (float) \App\Models\RestaurantPOS\MenuItem::sum('price'),
            'orders' => \App\Models\RestaurantPOS\Order::count(),
            'orderItems' => \App\Models\RestaurantPOS\OrderItem::count(),
            'orderItems_sum' => 0,
            'payments' => \App\Models\RestaurantPOS\Payment::count(),
            'payments_sum' => (float) \App\Models\RestaurantPOS\Payment::sum('amount'),
            'recipes' => \App\Models\RestaurantPOS\Recipe::count(),
            'waiters' => \App\Models\RestaurantPOS\Waiter::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}
