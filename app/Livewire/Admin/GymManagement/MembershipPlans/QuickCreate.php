<?php

namespace App\Livewire\Admin\GymManagement\MembershipPlans;

use App\Models\GymManagement\MembershipPlan;
use App\Domain\GymManagement\MembershipPlan\DTOs\MembershipPlanDTO;
use App\Domain\GymManagement\MembershipPlan\Actions\CreateMembershipPlanAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $duration_days = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.gym-management.membership-plans.quick-create', [
        ]); }

    public function store(CreateMembershipPlanAction $action)
    {
        $this->validate();
        $dto = MembershipPlanDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('membership-plan-created', id: $item->id);
        $this->js("Livewire.dispatch('membership-plan-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('gym-management/membership-plans.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'price', 'duration_days']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return MembershipPlan::rules(); }
}