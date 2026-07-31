<?php

namespace App\Livewire\Admin\CRM\Tasks;

use App\Models\CRM\Task;
use App\Domain\CRM\Task\DTOs\TaskDTO;
use App\Domain\CRM\Task\Actions\CreateTaskAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.c-r-m.tasks.quick-create', [
            'deals' => $this->getdealsList(),
        ]); }

    public function store(CreateTaskAction $action)
    {
        $this->validate();
        $dto = TaskDTO::fromArray([
            'title' => $this->title,
            'deal_id' => $this->deal_id,
            'due_date' => $this->due_date,
            'completed' => $this->completed,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('task-created', id: $item->id);
        $this->js("Livewire.dispatch('task-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('c-r-m/tasks.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->title ?? $item->id);
        $this->reset(['title', 'deal_id', 'due_date', 'completed']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Task::rules(); }
}