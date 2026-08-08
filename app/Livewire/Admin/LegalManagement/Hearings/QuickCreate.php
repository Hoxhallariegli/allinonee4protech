<?php

namespace App\Livewire\Admin\LegalManagement\Hearings;

use App\Models\LegalManagement\Hearing;
use App\Domain\LegalManagement\Hearing\DTOs\HearingDTO;
use App\Domain\LegalManagement\Hearing\Actions\CreateHearingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $case_id = '';
    public $hearing_date = '';
    public $location = '';
 
    #[On('legal-case-created')] 
    public function refreshCases($id) { $this->case_id = $id; $this->updatedCaseId($id); }
 
    public function updatedCaseId($value)
    {
        if (!$value) return;
        $related = \App\Models\LegalManagement\LegalCase::find($value);
        if (!$related) return;
    }
 
    protected function getcasesList() {
        return \App\Models\LegalManagement\LegalCase::pluck('title', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.legal-management.hearings.quick-create', [
            'cases' => $this->getcasesList(),
        ]); }

    public function store(CreateHearingAction $action)
    {
        $this->validate();
        $dto = HearingDTO::fromArray([
            'case_id' => $this->case_id,
            'hearing_date' => $this->hearing_date,
            'location' => $this->location,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('hearing-created', id: $item->id);
        $this->js("Livewire.dispatch('hearing-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('legal-management/hearings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['case_id', 'hearing_date', 'location']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Hearing::rules(); }
}