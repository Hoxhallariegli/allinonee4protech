<?php

namespace App\Livewire\Admin\BerberApp\Barbers;

use App\Models\BerberApp\Barber;
use App\Domain\BerberApp\Barber\DTOs\BarberDTO;
use App\Domain\BerberApp\Barber\Actions\CreateBarberAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Barber')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $photo = '';
    public $specialization = '';
    public $active = '';
    public $user_id = '';

    public function render() {
        abort_if_cannot('add_barbers');
        return view('livewire.admin.berber-app.barbers.create', [
            'users' => \App\Models\User::all()
        ])->layout('components.layouts.app');
    }
    public function store(CreateBarberAction $action) { $this->validate();  $dto = BarberDTO::fromArray([
            'name' => $this->name,
            'photo' => $this->photo,
            'specialization' => $this->specialization,
            'active' => $this->active,
            'user_id' => $this->user_id,
        ]); $action->execute($dto); session()->flash('success', __('berber-app/barbers.created')); return to_route('admin.berber-app.barbers.index'); }
    protected function rules(): array { return Barber::rules(); }
}
