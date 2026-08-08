<?php

namespace App\Livewire\Admin\AutoRepairManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('AutoRepairManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['appointments'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\Appointment::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['customers'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\Customer::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['customerAddresses'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\CustomerAddress::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['employees'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\Employee::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['expenseTrackings'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\AutoRepairManagement\ExpenseTracking::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['insuranceClaims'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\InsuranceClaim::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['inventories'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\Inventory::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['invoices'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\Invoice::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['jobCards'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\JobCard::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['jobCardParts'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\AutoRepairManagement\JobCardPart::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['jobCardServices'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\AutoRepairManagement\JobCardService::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['mechanics'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\Mechanic::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['parts'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\AutoRepairManagement\Part::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['payments'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\AutoRepairManagement\Payment::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['services'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\AutoRepairManagement\Service::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['vehicles'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\Vehicle::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['vehicleBrands'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\VehicleBrand::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['vehicleDocuments'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\VehicleDocument::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['vehicleModels'] = collect(range(6, 0))->map(fn($i) => \App\Models\AutoRepairManagement\VehicleModel::whereDate('created_at', now()->subDays($i))->count())->toArray();

        $layout = request()->is('auto-repair-management-module*') ? 'modules.AutoRepairManagement.Layouts.app' : 'components.layouts.app';
        

        return view('livewire.admin.auto-repair-management.dashboard', [
            'stats' => [
            'appointments' => \App\Models\AutoRepairManagement\Appointment::count(),
            'customers' => \App\Models\AutoRepairManagement\Customer::count(),
            'customerAddresses' => \App\Models\AutoRepairManagement\CustomerAddress::count(),
            'employees' => \App\Models\AutoRepairManagement\Employee::count(),
            'expenseTrackings' => \App\Models\AutoRepairManagement\ExpenseTracking::count(),
            'expenseTrackings_sum' => (float) \App\Models\AutoRepairManagement\ExpenseTracking::sum('amount'),
            'insuranceClaims' => \App\Models\AutoRepairManagement\InsuranceClaim::count(),
            'inventories' => \App\Models\AutoRepairManagement\Inventory::count(),
            'invoices' => \App\Models\AutoRepairManagement\Invoice::count(),
            'jobCards' => \App\Models\AutoRepairManagement\JobCard::count(),
            'jobCardParts' => \App\Models\AutoRepairManagement\JobCardPart::count(),
            'jobCardParts_sum' => (float) \App\Models\AutoRepairManagement\JobCardPart::sum('price'),
            'jobCardServices' => \App\Models\AutoRepairManagement\JobCardService::count(),
            'jobCardServices_sum' => (float) \App\Models\AutoRepairManagement\JobCardService::sum('price'),
            'mechanics' => \App\Models\AutoRepairManagement\Mechanic::count(),
            'parts' => \App\Models\AutoRepairManagement\Part::count(),
            'parts_sum' => (float) \App\Models\AutoRepairManagement\Part::sum('price'),
            'payments' => \App\Models\AutoRepairManagement\Payment::count(),
            'payments_sum' => (float) \App\Models\AutoRepairManagement\Payment::sum('amount'),
            'services' => \App\Models\AutoRepairManagement\Service::count(),
            'services_sum' => (float) \App\Models\AutoRepairManagement\Service::sum('price'),
            'vehicles' => \App\Models\AutoRepairManagement\Vehicle::count(),
            'vehicleBrands' => \App\Models\AutoRepairManagement\VehicleBrand::count(),
            'vehicleDocuments' => \App\Models\AutoRepairManagement\VehicleDocument::count(),
            'vehicleModels' => \App\Models\AutoRepairManagement\VehicleModel::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}