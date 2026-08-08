<?php

namespace App\Livewire\Admin\Finance\Budgets;

use App\Models\Finance\Budget;
use App\Domain\Finance\Budget\DTOs\BudgetDTO;
use App\Domain\Finance\Budget\Actions\UpdateBudgetAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Budget')]
class Edit extends Component
{
        use WithPagination;
 public Budget $item;
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

    public function mount(Budget $budget) { $this->item = $budget; $this->fill($budget->toArray());  }
    public function render() {
        abort_if_cannot('edit_budgets');
        return view('livewire.admin.finance.budgets.edit', [
            'categories' => $this->getcategoriesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateBudgetAction $action) { $this->validate();  $dto = BudgetDTO::fromArray([
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'period' => $this->period,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('finance/budgets.updated')); return to_route('admin.finance.budgets.index'); }
    protected function rules(): array { return Budget::rules($this->item->id); }
}