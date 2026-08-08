<?php

namespace App\Livewire\Admin\Finance\Expenses;

use App\Models\Finance\Expense;
use App\Domain\Finance\Expense\DTOs\ExpenseDTO;
use App\Domain\Finance\Expense\Actions\UpdateExpenseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Expense')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Expense $item;
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

    public function mount(Expense $expense) { $this->item = $expense; $this->fill($expense->toArray()); $this->date = $expense->date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_expenses');
        return view('livewire.admin.finance.expenses.edit', [
            'categories' => $this->getcategoriesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateExpenseAction $action) { $this->validate();         if ($this->attachment_file && !is_string($this->attachment_file)) { $this->attachment_file = $this->attachment_file->store('uploads/expenses', 'uploads'); }
 $dto = ExpenseDTO::fromArray([
            'amount' => $this->amount,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'attachment_file' => $this->attachment_file,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('finance/expenses.updated')); return to_route('admin.finance.expenses.index'); }
    protected function rules(): array { return Expense::rules($this->item->id); }
}