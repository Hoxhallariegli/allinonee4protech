<?php

namespace App\Livewire\Admin\LegalManagement\Hearings;

use App\Models\LegalManagement\Hearing;
use App\Domain\LegalManagement\Hearing\DTOs\HearingDTO;
use App\Domain\LegalManagement\Hearing\Actions\UpdateHearingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Hearing')]
class Edit extends Component
{
        use WithPagination;
 public Hearing $item;
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

    public function mount(Hearing $hearing) { $this->item = $hearing; $this->fill($hearing->toArray()); $this->hearing_date = $hearing->hearing_date?->format('Y-m-d\TH:i'); }
    public function render() {
        abort_if_cannot('edit_hearings');
        return view('livewire.admin.legal-management.hearings.edit', [
            'cases' => $this->getcasesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateHearingAction $action) { $this->validate();  $dto = HearingDTO::fromArray([
            'case_id' => $this->case_id,
            'hearing_date' => $this->hearing_date,
            'location' => $this->location,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('legal-management/hearings.updated')); return to_route('admin.legal-management.hearings.index'); }
    protected function rules(): array { return Hearing::rules($this->item->id); }
}