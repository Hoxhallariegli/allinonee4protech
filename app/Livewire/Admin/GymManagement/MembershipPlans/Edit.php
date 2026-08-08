<?php

namespace App\Livewire\Admin\GymManagement\MembershipPlans;

use App\Models\GymManagement\MembershipPlan;
use App\Domain\GymManagement\MembershipPlan\DTOs\MembershipPlanDTO;
use App\Domain\GymManagement\MembershipPlan\Actions\UpdateMembershipPlanAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit MembershipPlan')]
class Edit extends Component
{
        use WithPagination;
 public MembershipPlan $item;
    public $name = '';
    public $price = '';
    public $duration_days = '';
   
    public function mount(MembershipPlan $membershipPlan) { $this->item = $membershipPlan; $this->fill($membershipPlan->toArray());  }
    public function render() {
        abort_if_cannot('edit_membership_plans');
        return view('livewire.admin.gym-management.membership-plans.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateMembershipPlanAction $action) { $this->validate();  $dto = MembershipPlanDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('gym-management/membership-plans.updated')); return to_route('admin.gym-management.membership-plans.index'); }
    protected function rules(): array { return MembershipPlan::rules($this->item->id); }
}