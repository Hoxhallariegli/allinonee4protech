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
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $phone = '';
    public $email = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.real-estate-c-r-m.owners.quick-create', [
        ]); }

    public function store(CreateOwnerAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/owners', 'uploads'); }
        $dto = OwnerDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('owner-created', id: $item->id);
        $this->js("Livewire.dispatch('owner-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('real-estate-c-r-m/owners.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'phone', 'email', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Owner::rules(); }
}