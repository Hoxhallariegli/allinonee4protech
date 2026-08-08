<?php

namespace App\Livewire\Admin\Finance;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Finance Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['accounts'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\Finance\Account::whereDate('created_at', now()->subDays($i))->sum('balance'))->toArray();
        $chartData['budgets'] = collect(range(6, 0))->map(fn($i) => \App\Models\Finance\Budget::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['categories'] = collect(range(6, 0))->map(fn($i) => \App\Models\Finance\Category::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['documents'] = collect(range(6, 0))->map(fn($i) => \App\Models\Finance\Document::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['expenses'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\Finance\Expense::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['transactions'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\Finance\Transaction::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();

        return view('livewire.admin.finance.dashboard', [
            'stats' => [
                'accounts' => \App\Models\Finance\Account::count(),
                'accounts_sum' => (float) \App\Models\Finance\Account::sum('balance'),
                'budgets' => \App\Models\Finance\Budget::count(),
                'categories' => \App\Models\Finance\Category::count(),
                'documents' => \App\Models\Finance\Document::count(),
                'expenses' => \App\Models\Finance\Expense::count(),
                'expenses_sum' => (float) \App\Models\Finance\Expense::sum('amount'),
                'transactions' => \App\Models\Finance\Transaction::count(),
                'transactions_sum' => (float) \App\Models\Finance\Transaction::sum('amount'),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}
