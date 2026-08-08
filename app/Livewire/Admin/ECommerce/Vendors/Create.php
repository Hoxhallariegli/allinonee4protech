<?php

namespace App\Livewire\Admin\ECommerce\Vendors;

use App\Models\ECommerce\Vendor;
use App\Domain\ECommerce\Vendor\DTOs\VendorDTO;
use App\Domain\ECommerce\Vendor\Actions\CreateVendorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Vendor')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public function render() {
        abort_if_cannot('add_vendors');
        return view('livewire.admin.e--commerce.vendors.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateVendorAction $action) { $this->validate();  $dto = VendorDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('e--commerce/vendors.created')); return to_route('admin.e--commerce.vendors.index'); }
    protected function rules(): array { return Vendor::rules(); }
}