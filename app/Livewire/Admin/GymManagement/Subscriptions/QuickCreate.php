<?php

namespace App\Livewire\Admin\GymManagement\Subscriptions;

use App\Models\GymManagement\Subscription;
use App\Domain\GymManagement\Subscription\DTOs\SubscriptionDTO;
use App\Domain\GymManagement\Subscription\Actions\CreateSubscriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.gym-management.subscriptions.quick-create', [
            'members' => $this->getmembersList(),
        ]); }

    public function store(CreateSubscriptionAction $action)
    {
        $this->validate();
        $dto = SubscriptionDTO::fromArray([
            'member_id' => $this->member_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('subscription-created', id: $item->id);
        $this->js("Livewire.dispatch('subscription-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('gym-management/subscriptions.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['member_id', 'start_date', 'end_date', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Subscription::rules(); }
}