<tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-none border-b border-gray-50 dark:border-gray-700/50 last:border-none">    <td class="px-4 py-5 font-bold text-blue-600 dark:text-blue-400">{{ $item->id }}</td>
    <td class="px-4 py-5 font-bold text-gray-900 dark:text-white">{{ $item->user->name ?? $item->user_id }}</td>
    <td class="px-4 py-5 font-bold text-gray-900 dark:text-white">{{ $item->product->name ?? $item->product_id }}</td>
    <td class="px-4 py-5 font-medium text-gray-600 dark:text-gray-300">{{ $item->quantity }}</td>
    <td class="px-4 py-5 font-medium text-gray-600 dark:text-gray-300">{{ $item->total_price }}</td>
    <td class="px-4 py-5 font-medium text-gray-600 dark:text-gray-300">{{ $item->sale_date?->format('d/m/Y') }}</td>
    <td class="px-4 py-5 font-medium text-gray-600 dark:text-gray-300">{{ $item->status }}</td>
    <td class="px-4 py-5 font-medium text-gray-600 dark:text-gray-300">{{ $item->notes }}</td>
    <td class="px-4 py-5 font-medium text-gray-600 dark:text-gray-300">{{ $item->no }}</td>
<td class="px-4 py-5 text-right"><div class="flex justify-end gap-3">@can('edit_sales')<x-a href="{{ route('admin.sales.edit', ['sale' => $item->id]) }}" class="!rounded-xl !bg-blue-50 dark:!bg-blue-900/30 !text-blue-600 dark:!text-blue-400 !px-4 !py-1.5 !text-[10px] !font-black !uppercase !border-none">{{ __('Edit') }}</x-a>@endcan @can('delete_sales')<button wire:click="deleteSale('{{ $item->id }}')" wire:confirm="{{ __('Are you sure?') }}" class="text-[10px] font-black uppercase text-red-400 hover:text-red-600 dark:hover:text-red-300 transition-none">{{ __('Delete') }}</button>@endcan</div></td></tr>