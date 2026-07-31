<?php

namespace App\Livewire\Admin\AutoRepairManagement\Reports;

use App\Models\AutoRepairManagement\Report;
use App\Domain\AutoRepairManagement\Report\DTOs\ReportDTO;
use App\Domain\AutoRepairManagement\Report\Actions\UpdateReportAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Report')]
class Edit extends Component
{
        use WithPagination;
 public Report $item;
    public $report_type = '';
    public $report_date = '';
   
    public function mount(Report $report) { $this->item = $report; $this->fill($report->toArray()); $this->report_date = $report->report_date?->format('Y-m-d'); }
    public function render() { abort_if_cannot('edit_reports'); return view('livewire.admin.auto-repair-management.reports.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateReportAction $action) { $this->validate();  $dto = ReportDTO::fromArray([
            'report_type' => $this->report_type,
            'report_date' => $this->report_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/reports.updated')); return to_route('admin.auto-repair-management.reports.index'); }
    protected function rules(): array { return Report::rules($this->item->id); }
}