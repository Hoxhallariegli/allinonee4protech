<?php

namespace App\Livewire\Admin\BerberApp\Barbers;

use App\Models\BerberApp\Barber;
use App\Domain\BerberApp\Barber\Queries\BarberListQuery;
use App\Domain\BerberApp\Barber\Actions\DeleteBarberAction;
use App\Domain\BerberApp\Barber\Actions\HandleBarberAbsence;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Barbers')]
class Barbers extends Component
{
    use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    // Absence State
    public $editingAbsenceId;
    public $absenceStart;
    public $absenceEnd;
    public $absenceType = 'emergency';
    public $absenceReason;

    public function editAbsence($id)
    {
        $absence = \App\Models\BerberApp\BarberException::findOrFail($id);
        $this->editingAbsenceId = $absence->id;
        $this->absenceStart = $absence->start_datetime->format('Y-m-d\TH:i');
        $this->absenceEnd = $absence->end_datetime->format('Y-m-d\TH:i');
        $this->absenceType = $absence->type;
        $this->absenceReason = $absence->reason;

        $this->js('on = true'); // Open modal
    }

    public function deleteAbsence($id)
    {
        \App\Models\BerberApp\BarberException::destroy($id);
        $this->dispatch('toast', message: 'Absenca u fshi.', type: 'success');
    }

    public function scheduleAbsence($barberId, HandleBarberAbsence $action)
    {
        $this->validate([
            'absenceStart' => 'required|date',
            'absenceEnd' => 'required|date|after:absenceStart',
            'absenceType' => 'required|in:emergency,vacation',
        ]);

        // Check for overlaps for the same barber
        $overlap = \App\Models\BerberApp\BarberException::where('barber_id', $barberId)
            ->where(function ($query) {
                $query->where('start_datetime', '<', $this->absenceEnd)
                      ->where('end_datetime', '>', $this->absenceStart);
            })
            ->when($this->editingAbsenceId, fn($q) => $query->where('id', '!=', $this->editingAbsenceId))
            ->exists();

        if ($overlap) {
            $this->addError('absenceStart', 'Ky berber ka një absencë tjetër që mbivendoset me këtë orar.');
            return;
        }

        if ($this->editingAbsenceId) {
            $absence = \App\Models\BerberApp\BarberException::find($this->editingAbsenceId);
            $absence->update([
                'start_datetime' => $this->absenceStart,
                'end_datetime' => $this->absenceEnd,
                'type' => $this->absenceType,
                'reason' => $this->absenceReason,
            ]);
        } else {
            $action->execute($barberId, $this->absenceStart, $this->absenceEnd, $this->absenceType, $this->absenceReason);
        }

        $this->reset(['absenceStart', 'absenceEnd', 'absenceType', 'absenceReason', 'editingAbsenceId']);
        $this->dispatch('toast', message: 'Absenca u përpunua me sukses.', type: 'success');
        $this->dispatch('close-modal');
    }

    public function resetAbsenceForm()
    {
        $this->reset(['absenceStart', 'absenceEnd', 'absenceType', 'absenceReason', 'editingAbsenceId']);
    }

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_barbers');
        $query = (new BarberListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.berber-app.barbers.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Barber::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Barber::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteBarber($id, DeleteBarberAction $action)
    {
        abort_if_cannot('delete_barbers');
        $item = Barber::find($id);
        if (!$item) { $this->dispatch('toast', message: __('berber-app/barbers.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('berber-app/barbers.deleted'), type: 'success'); $this->resetPage(); }
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('berber-app/barbers.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('berber-app/barbers.delete_error'), type: 'error'); }
    }
}
