<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Report;
use App\Domain\Report\DTOs\ReportDTO;
use App\Domain\Report\Actions\CreateReportAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $report_type = '';
    public $report_date = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.reports.quick-create', [
        ]); }

    public function store(CreateReportAction $action)
    {
        $this->validate();
        $dto = ReportDTO::fromArray([
            'report_type' => $this->report_type,
            'report_date' => $this->report_date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('report-created', id: $item->id);
        $this->js("Livewire.dispatch('report-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('reports.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['report_type', 'report_date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Report::rules(); }
}