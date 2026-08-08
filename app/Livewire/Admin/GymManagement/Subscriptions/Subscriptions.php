<?php

namespace App\Livewire\Admin\GymManagement\Subscriptions;

use App\Models\GymManagement\Subscription;
use App\Domain\GymManagement\Subscription\Queries\SubscriptionListQuery;
use App\Domain\GymManagement\Subscription\Actions\DeleteSubscriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Subscriptions')]
class Subscriptions extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $member_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'member_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_subscriptions');
        $query = (new SubscriptionListQuery())->handle(['search' => $this->search,             'member_id' => $this->member_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.gym-management.subscriptions.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Subscription::sortable(),
            'members' => \App\Models\GymManagement\Member::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Subscription::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteSubscription($id, DeleteSubscriptionAction $action) 
    {
        abort_if_cannot('delete_subscriptions');
        $item = Subscription::find($id);
        if (!$item) { $this->dispatch('toast', message: __('gym-management/subscriptions.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('gym-management/subscriptions.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('gym-management/subscriptions.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('gym-management/subscriptions.delete_error'), type: 'error'); }
    }
}