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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.construction-e-r-p.progress-reports.quick-create', [
            'projects' => $this->getprojectsList(),
        ]); }

    public function store(CreateProgressReportAction $action)
    {
        $this->validate();
        $dto = ProgressReportDTO::fromArray([
            'project_id' => $this->project_id,
            'report_date' => $this->report_date,
            'percentage' => $this->percentage,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('progress-report-created', id: $item->id);
        $this->js("Livewire.dispatch('progress-report-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/progress-reports.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['project_id', 'report_date', 'percentage']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return ProgressReport::rules(); }
}