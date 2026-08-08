<?php

namespace App\Livewire\Admin\SchoolManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('SchoolManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['assignments'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Assignment::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['attendances'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Attendance::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['grades'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Grade::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['guardians'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Guardian::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['guardianAddresses'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\GuardianAddress::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['payments'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\SchoolManagement\Payment::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['schoolClasses'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\SchoolClass::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['students'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Student::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['subjects'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Subject::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['teachers'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Teacher::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['timetables'] = collect(range(6, 0))->map(fn($i) => \App\Models\SchoolManagement\Timetable::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.school-management.dashboard', [
            'stats' => [
            'assignments' => \App\Models\SchoolManagement\Assignment::count(),
            'attendances' => \App\Models\SchoolManagement\Attendance::count(),
            'grades' => \App\Models\SchoolManagement\Grade::count(),
            'guardians' => \App\Models\SchoolManagement\Guardian::count(),
            'guardianAddresses' => \App\Models\SchoolManagement\GuardianAddress::count(),
            'payments' => \App\Models\SchoolManagement\Payment::count(),
            'payments_sum' => (float) \App\Models\SchoolManagement\Payment::sum('amount'),
            'schoolClasses' => \App\Models\SchoolManagement\SchoolClass::count(),
            'students' => \App\Models\SchoolManagement\Student::count(),
            'subjects' => \App\Models\SchoolManagement\Subject::count(),
            'teachers' => \App\Models\SchoolManagement\Teacher::count(),
            'timetables' => \App\Models\SchoolManagement\Timetable::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}