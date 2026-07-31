<?php

namespace App\Livewire\Admin\ClinicManagement\Visits;

use App\Models\ClinicManagement\Visit;
use App\Domain\ClinicManagement\Visit\Queries\VisitListQuery;
use App\Domain\ClinicManagement\Visit\Actions\DeleteVisitAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Visits')]
class Visits extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $patient_id = '';
    #[Url(history: true)] public $doctor_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'patient_id', 'doctor_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_visits');
        $query = (new VisitListQuery())->handle(['search' => $this->search,             'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.clinic-management.visits.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Visit::sortable(),
            'patients' => \App\Models\ClinicManagement\Patient::pluck('name', 'id')->toArray(),
            'doctors' => \App\Models\ClinicManagement\Doctor::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Visit::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteVisit($id, DeleteVisitAction $action) 
    {
        abort_if_cannot('delete_visits');
        $item = Visit::find($id);
        if (!$item) { $this->dispatch('toast', message: __('clinic-management/visits.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('clinic-management/visits.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('clinic-management/visits.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('clinic-management/visits.delete_error'), type: 'error'); }
    }
}