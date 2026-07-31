<?php

namespace App\Livewire\Admin\CRM\Companies;

use App\Models\CRM\Company;
use App\Domain\CRM\Company\DTOs\CompanyDTO;
use App\Domain\CRM\Company\Actions\CreateCompanyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $industry = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.c-r-m.companies.quick-create', [
        ]); }

    public function store(CreateCompanyAction $action)
    {
        $this->validate();
        $dto = CompanyDTO::fromArray([
            'name' => $this->name,
            'industry' => $this->industry,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('company-created', id: $item->id);
        $this->js("Livewire.dispatch('company-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('c-r-m/companies.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'industry', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Company::rules(); }
}