<?php

namespace App\Livewire\Admin\GymManagement\Subscriptions;

use App\Models\GymManagement\Subscription;
use App\Domain\GymManagement\Subscription\DTOs\SubscriptionDTO;
use App\Domain\GymManagement\Subscription\Actions\UpdateSubscriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Subscription')]
class Edit extends Component
{
        use WithPagination;
 public Subscription $item;
    public $member_id = '';
    public $start_date = '';
    public $end_date = '';
    public $status = '';
 
    #[On('member-created')] 
    public function refreshMembers($id) { $this->member_id = $id; $this->updatedMemberId($id); }
 
    public function updatedMemberId($value)
    {
        if (!$value) return;
        $related = \App\Models\GymManagement\Member::find($value);
        if (!$related) return;
    }
 
    protected function getmembersList() {
        return \App\Models\GymManagement\Member::pluck('name', 'id')->toArray();
    }

    public function mount(Subscription $subscription) { $this->item = $subscription; $this->fill($subscription->toArray()); $this->start_date = $subscription->start_date?->format('Y-m-d'); $this->end_date = $subscription->end_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_subscriptions');
        return view('livewire.admin.gym-management.subscriptions.edit', [
            'members' => $this->getmembersList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateSubscriptionAction $action) { $this->validate();  $dto = SubscriptionDTO::fromArray([
            'member_id' => $this->member_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('gym-management/subscriptions.updated')); return to_route('admin.gym-management.subscriptions.index'); }
    protected function rules(): array { return Subscription::rules($this->item->id); }
}