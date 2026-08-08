<?php

namespace App\Livewire\Admin\Finance\Budgets;

use App\Models\Finance\Budget;
use App\Domain\Finance\Budget\DTOs\BudgetDTO;
use App\Domain\Finance\Budget\Actions\CreateBudgetAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Budget')]
class Create extends Component
{
        use WithPagination;
     public $category_id = '';
    public $amount = '';
    public $period = '';
 
    #[On('category-created')] 
    public function refreshCategories($id) { $this->category_id = $id; $this->updatedCategoryId($id); }
 
    public function updatedCategoryId($value)
    {
        if (!$value) return;
        $related = \App\Models\Finance\Category::find($value);
        if (!$related) return;
    }
 
    protected function getcategoriesList() {
        return \App\Models\Finance\Category::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_budgets');
        return view('livewire.admin.finance.budgets.create', [
            'categories' => $this->getcategoriesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateBudgetAction $action) { $this->validate();  $dto = BudgetDTO::fromArray([
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'period' => $this->period,
        ]); $action->execute($dto); session()->flash('success', __('finance/budgets.created')); return to_route('admin.finance.budgets.index'); }
    protected function rules(): array { return Budget::rules(); }
}