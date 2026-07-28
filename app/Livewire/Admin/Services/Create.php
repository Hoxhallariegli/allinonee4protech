<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use App\Domain\Service\DTOs\ServiceDTO;
use App\Domain\Service\Actions\CreateServiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Service')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $duration = '';
   
    public function render() { abort_if_cannot('add_services'); return view('livewire.admin.services.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateServiceAction $action) { $this->validate();  $dto = ServiceDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration' => $this->duration,
        ]); $action->execute($dto); session()->flash('success', __('services.created')); return to_route('admin.services.index'); }
    protected function rules(): array { return Service::rules(); }
}