<?php

namespace App\Livewire\Admin\LegalManagement\Hearings;

use App\Models\LegalManagement\Hearing;
use App\Domain\LegalManagement\Hearing\Queries\HearingListQuery;
use App\Domain\LegalManagement\Hearing\Actions\DeleteHearingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Hearings')]
class Hearings extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $case_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'case_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_hearings');
        $query = (new HearingListQuery())->handle(['search' => $this->search,             'case_id' => $this->case_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.legal-management.hearings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Hearing::sortable(),
            'cases' => \App\Models\LegalManagement\LegalCase::pluck('title', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Hearing::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteHearing($id, DeleteHearingAction $action) 
    {
        abort_if_cannot('delete_hearings');
        $item = Hearing::find($id);
        if (!$item) { $this->dispatch('toast', message: __('legal-management/hearings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('legal-management/hearings.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('legal-management/hearings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('legal-management/hearings.delete_error'), type: 'error'); }
    }
}