<div class="space-y-10">
    <div>
        <x-h1>{{ __('admin.Restaurant POS Dashboard') }}</x-h1>
        <x-short-description>Operational overview for Restaurant POS</x-short-description>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card p-6 flex items-center gap-4">
            <div class="size-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center"><x-heroicon-o-shopping-cart class="size-6"/></div>
            <div><p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Active Orders</p><p class="text-2xl font-black">{{ \App\Models\RestaurantPOS\Order::where('status', '!=', 'paid')->count() }}</p></div>
        </div>
        <div class="card p-6 flex items-center gap-4">
            <div class="size-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center"><x-heroicon-o-banknotes class="size-6"/></div>
            <div><p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Sales</p><p class="text-2xl font-black">{{ \App\Models\RestaurantPOS\Payment::count() }}</p></div>
        </div>
    </div>
</div>
