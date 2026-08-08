<?php

namespace App\Livewire\Admin\BerberApp\Services;

use App\Models\BerberApp\Service;
use App\Domain\BerberApp\Service\DTOs\ServiceDTO;
use App\Domain\BerberApp\Service\Actions\UpdateServiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Service')]
class Edit extends Component
{
        use WithPagination;
 public Service $item;
    public $name = '';
    public $price = '';
    public $duration_minutes = '';

    public function mount(Service $service) { $this->item = $service; $this->fill($service->toArray());  }
    public function render() {
        abort_if_cannot('edit_services');
        return view('livewire.admin.berber-app.services.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateServiceAction $action) { $this->validate();  $dto = ServiceDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration_minutes' => $this->duration_minutes,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('berber-app/services.updated')); return to_route('admin.berber-app.services.index'); }
    protected function rules(): array { return Service::rules($this->item->id); }
}
