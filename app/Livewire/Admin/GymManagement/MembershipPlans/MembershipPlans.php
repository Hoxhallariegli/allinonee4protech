<?php

namespace App\Livewire\Admin\GymManagement\MembershipPlans;

use App\Models\GymManagement\MembershipPlan;
use App\Domain\GymManagement\MembershipPlan\Queries\MembershipPlanListQuery;
use App\Domain\GymManagement\MembershipPlan\Actions\DeleteMembershipPlanAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('MembershipPlans')]
class MembershipPlans extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_membership_plans');
        $query = (new MembershipPlanListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.gym-management.membership-plans.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => MembershipPlan::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, MembershipPlan::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteMembershipPlan($id, DeleteMembershipPlanAction $action) 
    {
        abort_if_cannot('delete_membership_plans');
        $item = MembershipPlan::find($id);
        if (!$item) { $this->dispatch('toast', message: __('gym-management/membership-plans.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('gym-management/membership-plans.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('gym-management/membership-plans.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('gym-management/membership-plans.delete_error'), type: 'error'); }
    }
}