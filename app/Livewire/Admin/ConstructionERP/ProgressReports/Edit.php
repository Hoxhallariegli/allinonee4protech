<?php

namespace App\Livewire\Admin\ConstructionERP\ProgressReports;

use App\Models\ConstructionERP\ProgressReport;
use App\Domain\ConstructionERP\ProgressReport\DTOs\ProgressReportDTO;
use App\Domain\ConstructionERP\ProgressReport\Actions\UpdateProgressReportAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit ProgressReport')]
class Edit extends Component
{
        use WithPagination;
 public ProgressReport $item;
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

    public function mount(ProgressReport $progressReport) { $this->item = $progressReport; $this->fill($progressReport->toArray()); $this->report_date = $progressReport->report_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_progress_reports');
        return view('livewire.admin.construction-e-r-p.progress-reports.edit', [
            'projects' => $this->getprojectsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateProgressReportAction $action) { $this->validate();  $dto = ProgressReportDTO::fromArray([
            'project_id' => $this->project_id,
            'report_date' => $this->report_date,
            'percentage' => $this->percentage,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/progress-reports.updated')); return to_route('admin.construction-e-r-p.progress-reports.index'); }
    protected function rules(): array { return ProgressReport::rules($this->item->id); }
}