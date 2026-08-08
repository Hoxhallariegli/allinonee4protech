<?php

namespace App\Livewire\Admin\CRM\Tasks;

use App\Models\CRM\Task;
use App\Domain\CRM\Task\DTOs\TaskDTO;
use App\Domain\CRM\Task\Actions\UpdateTaskAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Task')]
class Edit extends Component
{
        use WithPagination;
 public Task $item;
    public $title = '';
    public $deal_id = '';
    public $due_date = '';
    public $completed = '';
 
    #[On('deal-created')] 
    public function refreshDeals($id) { $this->deal_id = $id; $this->updatedDealId($id); }
 
    public function updatedDealId($value)
    {
        if (!$value) return;
        $related = \App\Models\CRM\Deal::find($value);
        if (!$related) return;
    }
 
    protected function getdealsList() {
        return \App\Models\CRM\Deal::pluck('name', 'id')->toArray();
    }

    public function mount(Task $task) { $this->item = $task; $this->fill($task->toArray()); $this->due_date = $task->due_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_tasks');
        return view('livewire.admin.c-r-m.tasks.edit', [
            'deals' => $this->getdealsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTaskAction $action) { $this->validate();  $dto = TaskDTO::fromArray([
            'title' => $this->title,
            'deal_id' => $this->deal_id,
            'due_date' => $this->due_date,
            'completed' => $this->completed,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('c-r-m/tasks.updated')); return to_route('admin.c-r-m.tasks.index'); }
    protected function rules(): array { return Task::rules($this->item->id); }
}