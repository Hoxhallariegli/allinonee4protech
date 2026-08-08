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
use Livewire\WithFileUploads;

#[Title('Add Company')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $industry = '';
    public $phone = '';
    public $logo = '';
   
    public function render() {
        abort_if_cannot('add_companies');
        return view('livewire.admin.c-r-m.companies.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateCompanyAction $action) { $this->validate();         if ($this->logo && !is_string($this->logo)) { $this->logo = $this->logo->store('uploads/companies', 'uploads'); }
 $dto = CompanyDTO::fromArray([
            'name' => $this->name,
            'industry' => $this->industry,
            'phone' => $this->phone,
            'logo' => $this->logo,
        ]); $action->execute($dto); session()->flash('success', __('c-r-m/companies.created')); return to_route('admin.c-r-m.companies.index'); }
    protected function rules(): array { return Company::rules(); }
}