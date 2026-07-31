<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCardParts;

use App\Models\AutoRepairManagement\JobCardPart;
use App\Domain\AutoRepairManagement\JobCardPart\Queries\JobCardPartListQuery;
use App\Domain\AutoRepairManagement\JobCardPart\Actions\DeleteJobCardPartAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('JobCardParts')]
class JobCardParts extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $job_card_id = '';
    #[Url(history: true)] public $part_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'job_card_id', 'part_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_job_card_parts');
        $query = (new JobCardPartListQuery())->handle(['search' => $this->search,             'job_card_id' => $this->job_card_id,
            'part_id' => $this->part_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.job-card-parts.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => JobCardPart::sortable(),
            'jobCards' => \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray(),
            'parts' => \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, JobCardPart::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteJobCardPart($id, DeleteJobCardPartAction $action) 
    {
        abort_if_cannot('delete_job_card_parts');
        $item = JobCardPart::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/job-card-parts.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/job-card-parts.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/job-card-parts.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/job-card-parts.delete_error'), type: 'error'); }
    }
}