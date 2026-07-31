<?php

namespace App\Livewire\Admin\CRM\Deals;

use App\Models\CRM\Deal;
use App\Domain\CRM\Deal\Queries\DealListQuery;
use App\Domain\CRM\Deal\Actions\DeleteDealAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Deals')]
class Deals extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $contact_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'contact_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_deals');
        $query = (new DealListQuery())->handle(['search' => $this->search,             'contact_id' => $this->contact_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.c-r-m.deals.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Deal::sortable(),
            'contacts' => \App\Models\CRM\Contact::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Deal::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteDeal($id, DeleteDealAction $action) 
    {
        abort_if_cannot('delete_deals');
        $item = Deal::find($id);
        if (!$item) { $this->dispatch('toast', message: __('c-r-m/deals.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('c-r-m/deals.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('c-r-m/deals.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('c-r-m/deals.delete_error'), type: 'error'); }
    }
}