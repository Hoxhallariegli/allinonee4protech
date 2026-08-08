<?php

namespace App\Livewire\Admin\RealEstateCRM\Owners;

use App\Models\RealEstateCRM\Owner;
use App\Domain\RealEstateCRM\Owner\DTOs\OwnerDTO;
use App\Domain\RealEstateCRM\Owner\Actions\UpdateOwnerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Owner')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Owner $item;
    public $name = '';
    public $phone = '';
    public $email = '';
    public $photo = '';
   
    public function mount(Owner $owner) { $this->item = $owner; $this->fill($owner->toArray());  }
    public function render() {
        abort_if_cannot('edit_owners');
        return view('livewire.admin.real-estate-c-r-m.owners.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateOwnerAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/owners', 'uploads'); }
 $dto = OwnerDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('real-estate-c-r-m/owners.updated')); return to_route('admin.real-estate-c-r-m.owners.index'); }
    protected function rules(): array { return Owner::rules($this->item->id); }
}