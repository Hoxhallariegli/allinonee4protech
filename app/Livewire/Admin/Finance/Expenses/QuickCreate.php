<?php

namespace App\Livewire\Admin\Finance\Expenses;

use App\Models\Finance\Expense;
use App\Domain\Finance\Expense\DTOs\ExpenseDTO;
use App\Domain\Finance\Expense\Actions\CreateExpenseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $amount = '';
    public $date = '';
    public $category_id = '';
    public $attachment_file = '';
 
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

    public function render() { return view('livewire.admin.finance.expenses.quick-create', [
            'categories' => $this->getcategoriesList(),
        ]); }

    public function store(CreateExpenseAction $action)
    {
        $this->validate();
        if ($this->attachment_file && !is_string($this->attachment_file)) { $this->attachment_file = $this->attachment_file->store('uploads/expenses', 'uploads'); }
        $dto = ExpenseDTO::fromArray([
            'amount' => $this->amount,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'attachment_file' => $this->attachment_file,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('expense-created', id: $item->id);
        $this->js("Livewire.dispatch('expense-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('finance/expenses.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['amount', 'date', 'category_id', 'attachment_file']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Expense::rules(); }
}