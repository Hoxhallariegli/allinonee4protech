<?php

namespace App\Livewire\Admin\RealEstateCRM\Owners;

use App\Models\RealEstateCRM\Owner;
use App\Domain\RealEstateCRM\Owner\DTOs\OwnerDTO;
use App\Domain\RealEstateCRM\Owner\Actions\CreateOwnerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Owner')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
    public $email = '';
   
    public function render() { abort_if_cannot('add_owners'); return view('livewire.admin.real-estate-c-r-m.owners.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateOwnerAction $action) { $this->validate();  $dto = OwnerDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('real-estate-c-r-m/owners.created')); return to_route('admin.real-estate-c-r-m.owners.index'); }
    protected function rules(): array { return Owner::rules(); }
}