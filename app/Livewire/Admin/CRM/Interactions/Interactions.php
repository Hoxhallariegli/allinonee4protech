<?php

namespace App\Livewire\Admin\CRM\Interactions;

use App\Models\CRM\Interaction;
use App\Domain\CRM\Interaction\Queries\InteractionListQuery;
use App\Domain\CRM\Interaction\Actions\DeleteInteractionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Interactions')]
class Interactions extends Component
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
        abort_if_cannot('view_interactions');
        $query = (new InteractionListQuery())->handle(['search' => $this->search,             'contact_id' => $this->contact_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.c-r-m.interactions.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Interaction::sortable(),
            'contacts' => \App\Models\CRM\Contact::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Interaction::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteInteraction($id, DeleteInteractionAction $action) 
    {
        abort_if_cannot('delete_interactions');
        $item = Interaction::find($id);
        if (!$item) { $this->dispatch('toast', message: __('c-r-m/interactions.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('c-r-m/interactions.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('c-r-m/interactions.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('c-r-m/interactions.delete_error'), type: 'error'); }
    }
}