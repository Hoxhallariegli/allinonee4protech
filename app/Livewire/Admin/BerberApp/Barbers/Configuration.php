<?php

namespace App\Livewire\Admin\BerberApp\Barbers;

use App\Models\BerberApp\Barber;
use App\Models\BerberApp\BarberWorkingHour;
use App\Models\BerberApp\BarberException;
use App\Domain\BerberApp\Barber\Actions\HandleBarberAbsence;
use Livewire\Component;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Title('Barber Configuration')]
class Configuration extends Component
{
    public Barber $barber;
    public $workingHours = [];

    // Absence Form
    public $absenceStart;
    public $absenceEnd;
    public $absenceType = 'emergency';
    public $absenceReason;
    public $editingAbsenceId;

    protected $rules = [
        'workingHours.*.start_time' => 'required',
        'workingHours.*.end_time' => 'required',
        'workingHours.*.is_off' => 'boolean',
    ];

    public function mount(Barber $barber)
    {
        $this->barber = $barber;
        $this->loadWorkingHours();
    }

    public function loadWorkingHours()
    {
        $days = [
            0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday',
            3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'
        ];

        $existing = $this->barber->workingHours->keyBy('day_of_week');

        foreach ($days as $index => $name) {
            if (isset($existing[$index])) {
                $this->workingHours[$index] = $existing[$index]->toArray();
            } else {
                $this->workingHours[$index] = [
                    'day_of_week' => $index,
                    'day_name' => $name,
                    'start_time' => '09:00',
                    'end_time' => '19:00',
                    'is_off' => ($index === 0) // Sunday off by default
                ];
            }
        }
    }

    public function saveWorkingHours()
    {
        foreach ($this->workingHours as $dayData) {
            BarberWorkingHour::updateOrCreate(
                ['barber_id' => $this->barber->id, 'day_of_week' => $dayData['day_of_week']],
                [
                    'start_time' => $dayData['start_time'],
                    'end_time' => $dayData['end_time'],
                    'is_off' => $dayData['is_off']
                ]
            );
        }

        $this->dispatch('toast', message: 'Working hours updated successfully.', type: 'success');
    }

    // Absence Management
    public function scheduleAbsence(HandleBarberAbsence $action)
    {
        $this->validate([
            'absenceStart' => 'required|date',
            'absenceEnd' => 'required|date|after:absenceStart',
            'absenceType' => 'required|in:emergency,vacation',
        ]);

        if ($this->editingAbsenceId) {
            $absence = BarberException::find($this->editingAbsenceId);
            $absence->update([
                'start_datetime' => $this->absenceStart,
                'end_datetime' => $this->absenceEnd,
                'type' => $this->absenceType,
                'reason' => $this->absenceReason,
            ]);
        } else {
            $action->execute($this->barber->id, $this->absenceStart, $this->absenceEnd, $this->absenceType, $this->absenceReason);
        }

        $this->reset(['absenceStart', 'absenceEnd', 'absenceType', 'absenceReason', 'editingAbsenceId']);
        $this->dispatch('toast', message: 'Absence processed.', type: 'success');
        $this->barber->load('exceptions');
    }

    public function editAbsence($id)
    {
        $absence = BarberException::findOrFail($id);
        $this->editingAbsenceId = $absence->id;
        $this->absenceStart = $absence->start_datetime->format('Y-m-d\TH:i');
        $this->absenceEnd = $absence->end_datetime->format('Y-m-d\TH:i');
        $this->absenceType = $absence->type;
        $this->absenceReason = $absence->reason;
    }

    public function deleteAbsence($id)
    {
        BarberException::destroy($id);
        $this->barber->load('exceptions');
        $this->dispatch('toast', message: 'Absence deleted.', type: 'success');
    }

    public function render()
    {
        return view('livewire.admin.berber-app.barbers.configuration', [
            'days' => [
                1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
                4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 0 => 'Sunday'
            ]
        ])->layout('components.layouts.app');
    }
}
