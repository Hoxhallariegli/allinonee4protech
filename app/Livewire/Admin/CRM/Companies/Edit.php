<?php

namespace App\Livewire\Admin\CRM\Companies;

use App\Models\CRM\Company;
use App\Domain\CRM\Company\DTOs\CompanyDTO;
use App\Domain\CRM\Company\Actions\UpdateCompanyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Company')]
class Edit extends Component
{
        use WithPagination;
 public Company $item;
    public $name = '';
    public $industry = '';
    public $phone = '';
   
    public function mount(Company $company) { $this->item = $company; $this->fill($company->toArray());  }
    public function render() { abort_if_cannot('edit_companies'); return view('livewire.admin.c-r-m.companies.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateCompanyAction $action) { $this->validate();  $dto = CompanyDTO::fromArray([
            'name' => $this->name,
            'industry' => $this->industry,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('c-r-m/companies.updated')); return to_route('admin.c-r-m.companies.index'); }
    protected function rules(): array { return Company::rules($this->item->id); }
}