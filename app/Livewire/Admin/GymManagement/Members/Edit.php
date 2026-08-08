<?php

namespace App\Livewire\Admin\GymManagement\Members;

use App\Models\GymManagement\Member;
use App\Domain\GymManagement\Member\DTOs\MemberDTO;
use App\Domain\GymManagement\Member\Actions\UpdateMemberAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Member')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Member $item;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $membership_plan_id = '';
    public $photo = '';
 
    #[On('membership-plan-created')] 
    public function refreshMembershipPlans($id) { $this->membership_plan_id = $id; $this->updatedMembershipPlanId($id); }
 
    public function updatedMembershipPlanId($value)
    {
        if (!$value) return;
        $related = \App\Models\GymManagement\MembershipPlan::find($value);
        if (!$related) return;
    }
 
    protected function getmembershipPlansList() {
        return \App\Models\GymManagement\MembershipPlan::pluck('name', 'id')->toArray();
    }

    public function mount(Member $member) { $this->item = $member; $this->fill($member->toArray());  }
    public function render() {
        abort_if_cannot('edit_members');
        return view('livewire.admin.gym-management.members.edit', [
            'membershipPlans' => $this->getmembershipPlansList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateMemberAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/members', 'uploads'); }
 $dto = MemberDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'membership_plan_id' => $this->membership_plan_id,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('gym-management/members.updated')); return to_route('admin.gym-management.members.index'); }
    protected function rules(): array { return Member::rules($this->item->id); }
}