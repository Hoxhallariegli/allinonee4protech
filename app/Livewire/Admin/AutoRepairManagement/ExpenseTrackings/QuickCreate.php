<?php

namespace App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings;

use App\Models\AutoRepairManagement\ExpenseTracking;
use App\Domain\AutoRepairManagement\ExpenseTracking\DTOs\ExpenseTrackingDTO;
use App\Domain\AutoRepairManagement\ExpenseTracking\Actions\CreateExpenseTrackingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $description = '';
    public $amount = '';
    public $date = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.expense-trackings.quick-create', [
        ]); }

    public function store(CreateExpenseTrackingAction $action)
    {
        $this->validate();
        $dto = ExpenseTrackingDTO::fromArray([
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('expense-tracking-created', id: $item->id);
        $this->js("Livewire.dispatch('expense-tracking-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/expense-trackings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['description', 'amount', 'date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return ExpenseTracking::rules(); }
}