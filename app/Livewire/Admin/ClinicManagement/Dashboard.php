<?php

namespace App\Livewire\Admin\ClinicManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ClinicManagement\Doctor;
use App\Models\ClinicManagement\Patient;
use App\Models\ClinicManagement\Visit;
use App\Models\ClinicManagement\ClinicInvoice;
use Carbon\Carbon;

#[Title('Clinic Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.clinic-management.dashboard', [
            'totalDoctors' => Doctor::count(),
            'totalPatients' => Patient::count(),
            'todayVisits' => Visit::whereDate('visit_date', today())->count(),
            'totalRevenue' => ClinicInvoice::where('status', 'paid')->sum('total_amount'),
            'recentVisits' => Visit::with(['doctor', 'patient'])->latest()->take(5)->get(),
        ]);
    }
}
