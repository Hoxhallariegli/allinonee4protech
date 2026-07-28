<?php

namespace App\Livewire\Admin\JobCards;

use App\Models\JobCard;
use App\Domain\JobCard\Queries\JobCardListQuery;
use App\Domain\JobCard\Actions\DeleteJobCardAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('JobCards')]
class JobCards extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $vehicle_id = '';
    #[Url(history: true)] public $customer_id = '';
    #[Url(history: true)] public $mechanic_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'vehicle_id', 'customer_id', 'mechanic_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_job_cards');
        $query = (new JobCardListQuery())->handle(['search' => $this->search,             'vehicle_id' => $this->vehicle_id,
            'customer_id' => $this->customer_id,
            'mechanic_id' => $this->mechanic_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.job-cards.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => JobCard::sortable(),
            'vehicles' => \App\Models\Vehicle::pluck('license_plate', 'id')->toArray(),
            'customers' => \App\Models\Customer::pluck('name', 'id')->toArray(),
            'mechanics' => \App\Models\Mechanic::with('employee')->get()->pluck('employee.name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, JobCard::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteJobCard($id, DeleteJobCardAction $action) 
    {
        abort_if_cannot('delete_job_cards');
        $item = JobCard::find($id);
        if (!$item) { $this->dispatch('toast', message: __('job-cards.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('job-cards.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('job-cards.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('job-cards.delete_error'), type: 'error'); }
    }
}