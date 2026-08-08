<?php

namespace App\Livewire\Admin\ECommerce\Vendors;

use App\Models\ECommerce\Vendor;
use App\Domain\ECommerce\Vendor\DTOs\VendorDTO;
use App\Domain\ECommerce\Vendor\Actions\UpdateVendorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Vendor')]
class Edit extends Component
{
        use WithPagination;
 public Vendor $item;
    public $name = '';
    public $email = '';
    public $phone = '';
   
    public function mount(Vendor $vendor) { $this->item = $vendor; $this->fill($vendor->toArray());  }
    public function render() {
        abort_if_cannot('edit_vendors');
        return view('livewire.admin.e--commerce.vendors.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateVendorAction $action) { $this->validate();  $dto = VendorDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('e--commerce/vendors.updated')); return to_route('admin.e--commerce.vendors.index'); }
    protected function rules(): array { return Vendor::rules($this->item->id); }
}