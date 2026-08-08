<?php

namespace App\Livewire\Admin\GymManagement\Members;

use App\Models\GymManagement\Member;
use App\Domain\GymManagement\Member\Queries\MemberListQuery;
use App\Domain\GymManagement\Member\Actions\DeleteMemberAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Members')]
class Members extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $membership_plan_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'membership_plan_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_members');
        $query = (new MemberListQuery())->handle(['search' => $this->search,             'membership_plan_id' => $this->membership_plan_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.gym-management.members.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Member::sortable(),
            'membershipPlans' => \App\Models\GymManagement\MembershipPlan::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Member::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteMember($id, DeleteMemberAction $action) 
    {
        abort_if_cannot('delete_members');
        $item = Member::find($id);
        if (!$item) { $this->dispatch('toast', message: __('gym-management/members.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('gym-management/members.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('gym-management/members.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('gym-management/members.delete_error'), type: 'error'); }
    }
}