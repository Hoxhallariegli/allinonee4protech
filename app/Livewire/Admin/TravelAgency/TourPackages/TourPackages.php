<?php

namespace App\Livewire\Admin\TravelAgency\TourPackages;

use App\Models\TravelAgency\TourPackage;
use App\Domain\TravelAgency\TourPackage\Queries\TourPackageListQuery;
use App\Domain\TravelAgency\TourPackage\Actions\DeleteTourPackageAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('TourPackages')]
class TourPackages extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $destination_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'destination_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_tour_packages');
        $query = (new TourPackageListQuery())->handle(['search' => $this->search,             'destination_id' => $this->destination_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.travel-agency.tour-packages.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => TourPackage::sortable(),
            'destinations' => \App\Models\TravelAgency\Destination::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, TourPackage::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteTourPackage($id, DeleteTourPackageAction $action) 
    {
        abort_if_cannot('delete_tour_packages');
        $item = TourPackage::find($id);
        if (!$item) { $this->dispatch('toast', message: __('travel-agency/tour-packages.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('travel-agency/tour-packages.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('travel-agency/tour-packages.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('travel-agency/tour-packages.delete_error'), type: 'error'); }
    }
}