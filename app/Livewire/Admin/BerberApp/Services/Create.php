<?php

namespace App\Livewire\Admin\BerberApp\Services;

use App\Models\BerberApp\Service;
use App\Domain\BerberApp\Service\DTOs\ServiceDTO;
use App\Domain\BerberApp\Service\Actions\CreateServiceAction;
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
    public $duration_minutes = '';

    public function render() {
        abort_if_cannot('add_services');
        return view('livewire.admin.berber-app.services.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateServiceAction $action) { $this->validate();  $dto = ServiceDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration_minutes' => $this->duration_minutes,
        ]); $action->execute($dto); session()->flash('success', __('berber-app/services.created')); return to_route('admin.berber-app.services.index'); }
    protected function rules(): array { return Service::rules(); }
}
