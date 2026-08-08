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

#[Title('Add MembershipPlan')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $duration_days = '';
   
    public function render() {
        abort_if_cannot('add_membership_plans');
        return view('livewire.admin.gym-management.membership-plans.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateMembershipPlanAction $action) { $this->validate();  $dto = MembershipPlanDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
        ]); $action->execute($dto); session()->flash('success', __('gym-management/membership-plans.created')); return to_route('admin.gym-management.membership-plans.index'); }
    protected function rules(): array { return MembershipPlan::rules(); }
}