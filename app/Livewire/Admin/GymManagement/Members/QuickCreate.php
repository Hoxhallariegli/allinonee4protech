<?php

namespace App\Livewire\Admin\GymManagement\Members;

use App\Models\GymManagement\Member;
use App\Domain\GymManagement\Member\DTOs\MemberDTO;
use App\Domain\GymManagement\Member\Actions\CreateMemberAction;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.gym-management.members.quick-create', [
            'membershipPlans' => $this->getmembershipPlansList(),
        ]); }

    public function store(CreateMemberAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/members', 'uploads'); }
        $dto = MemberDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'membership_plan_id' => $this->membership_plan_id,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('member-created', id: $item->id);
        $this->js("Livewire.dispatch('member-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('gym-management/members.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email', 'phone', 'membership_plan_id', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Member::rules(); }
}