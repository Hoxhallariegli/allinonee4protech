<?php

namespace App\Livewire\Admin\BerberApp\Barbers;

use App\Models\BerberApp\Barber;
use App\Domain\BerberApp\Barber\DTOs\BarberDTO;
use App\Domain\BerberApp\Barber\Actions\UpdateBarberAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Barber')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Barber $item;
    public $name = '';
    public $photo = '';
    public $specialization = '';
    public $active = '';
    public $user_id = '';

    public function mount(Barber $barber) { $this->item = $barber; $this->fill($barber->toArray());  }
    public function render() {
        abort_if_cannot('edit_barbers');
        return view('livewire.admin.berber-app.barbers.edit', [
            'users' => \App\Models\User::all()
        ])->layout('components.layouts.app');
    }
    public function update(UpdateBarberAction $action) { $this->validate();  $dto = BarberDTO::fromArray([
            'name' => $this->name,
            'photo' => $this->photo,
            'specialization' => $this->specialization,
            'active' => $this->active,
            'user_id' => $this->user_id,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('berber-app/barbers.updated')); return to_route('admin.berber-app.barbers.index'); }
    protected function rules(): array { return Barber::rules($this->item->id); }
}
