<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Domain\Appointment\Queries\AppointmentListQuery;
use App\Domain\Appointment\Actions\DeleteAppointmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Appointments')]
class Appointments extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $vehicle_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'vehicle_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_appointments');
        $query = (new AppointmentListQuery())->handle(['search' => $this->search,             'vehicle_id' => $this->vehicle_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.appointments.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Appointment::sortable(),
            'vehicles' => \App\Models\Vehicle::pluck('license_plate', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Appointment::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteAppointment($id, DeleteAppointmentAction $action) 
    {
        abort_if_cannot('delete_appointments');
        $item = Appointment::find($id);
        if (!$item) { $this->dispatch('toast', message: __('appointments.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('appointments.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('appointments.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('appointments.delete_error'), type: 'error'); }
    }
}