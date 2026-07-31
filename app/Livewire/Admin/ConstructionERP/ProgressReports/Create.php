<?php

namespace App\Livewire\Admin\ConstructionERP\ProgressReports;

use App\Models\ConstructionERP\ProgressReport;
use App\Domain\ConstructionERP\ProgressReport\DTOs\ProgressReportDTO;
use App\Domain\ConstructionERP\ProgressReport\Actions\CreateProgressReportAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add ProgressReport')]
class Create extends Component
{
        use WithPagination;
     public $project_id = '';
    public $report_date = '';
    public $percentage = '';
 
    #[On('project-created')] 
    public function refreshProjects($id) { $this->project_id = $id; $this->updatedProjectId($id); }
 
    public function updatedProjectId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Project::find($value);
        if (!$related) return;
    }
 
    protected function getprojectsList() {
        return \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_progress_reports'); return view('livewire.admin.construction-e-r-p.progress-reports.create', [
            'projects' => $this->getprojectsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateProgressReportAction $action) { $this->validate();  $dto = ProgressReportDTO::fromArray([
            'project_id' => $this->project_id,
            'report_date' => $this->report_date,
            'percentage' => $this->percentage,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/progress-reports.created')); return to_route('admin.construction-e-r-p.progress-reports.index'); }
    protected function rules(): array { return ProgressReport::rules(); }
}