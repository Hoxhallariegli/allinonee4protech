<?php

namespace App\Livewire\Admin\AutoRepairManagement\Reports;

use App\Models\AutoRepairManagement\Report;
use App\Domain\AutoRepairManagement\Report\DTOs\ReportDTO;
use App\Domain\AutoRepairManagement\Report\Actions\CreateReportAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Report')]
class Create extends Component
{
        use WithPagination;
     public $report_type = '';
    public $report_date = '';
   
    public function render() { abort_if_cannot('add_reports'); return view('livewire.admin.auto-repair-management.reports.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateReportAction $action) { $this->validate();  $dto = ReportDTO::fromArray([
            'report_type' => $this->report_type,
            'report_date' => $this->report_date,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/reports.created')); return to_route('admin.auto-repair-management.reports.index'); }
    protected function rules(): array { return Report::rules(); }
}