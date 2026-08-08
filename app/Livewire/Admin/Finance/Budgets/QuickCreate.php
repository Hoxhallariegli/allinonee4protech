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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.finance.budgets.quick-create', [
            'categories' => $this->getcategoriesList(),
        ]); }

    public function store(CreateBudgetAction $action)
    {
        $this->validate();
        $dto = BudgetDTO::fromArray([
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'period' => $this->period,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('budget-created', id: $item->id);
        $this->js("Livewire.dispatch('budget-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('finance/budgets.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['category_id', 'amount', 'period']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Budget::rules(); }
}