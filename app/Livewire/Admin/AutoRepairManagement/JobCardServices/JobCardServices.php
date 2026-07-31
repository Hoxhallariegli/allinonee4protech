<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCardServices;

use App\Models\AutoRepairManagement\JobCardService;
use App\Domain\AutoRepairManagement\JobCardService\Queries\JobCardServiceListQuery;
use App\Domain\AutoRepairManagement\JobCardService\Actions\DeleteJobCardServiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('JobCardServices')]
class JobCardServices extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $job_card_id = '';
    #[Url(history: true)] public $service_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'job_card_id', 'service_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_job_card_services');
        $query = (new JobCardServiceListQuery())->handle(['search' => $this->search,             'job_card_id' => $this->job_card_id,
            'service_id' => $this->service_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.job-card-services.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => JobCardService::sortable(),
            'jobCards' => \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray(),
            'services' => \App\Models\AutoRepairManagement\Service::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, JobCardService::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteJobCardService($id, DeleteJobCardServiceAction $action) 
    {
        abort_if_cannot('delete_job_card_services');
        $item = JobCardService::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/job-card-services.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/job-card-services.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/job-card-services.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/job-card-services.delete_error'), type: 'error'); }
    }
}