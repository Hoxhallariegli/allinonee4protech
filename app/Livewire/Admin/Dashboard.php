<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render(): View
    {
        abort_if_cannot('view_dashboard');

        $stats = [
            'total_customers' => $this->getModelCount('App\Models\Customer'),
            'total_vehicles'  => $this->getModelCount('App\Models\Vehicle'),
            'active_job_cards' => $this->getJobCardCount(),
            'total_revenue'    => $this->getRevenue(),
        ];

        $recentJobCards = $this->getRecentJobCards();
        $upcomingAppointments = $this->getUpcomingAppointments();
        $lowStockParts = $this->getLowStockParts();

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'recentJobCards' => $recentJobCards,
            'upcomingAppointments' => $upcomingAppointments,
            'lowStockParts' => $lowStockParts,
        ]);
    }

    protected function getModelCount($class)
    {
        return class_exists($class) ? $class::count() : 0;
    }

    protected function getJobCardCount()
    {
        if (class_exists('App\Models\JobCard')) {
            return \App\Models\JobCard::where('status', '!=', 'closed')->count();
        }
        return 0;
    }

    protected function getRevenue()
    {
        if (class_exists('App\Models\Invoice')) {
            return \App\Models\Invoice::where('status', 'paid')->sum('total');
        }
        return 0;
    }

    protected function getRecentJobCards()
    {
        if (class_exists('App\Models\JobCard')) {
            return \App\Models\JobCard::with(['vehicle', 'customer'])
                ->latest()
                ->take(5)
                ->get();
        }
        return collect();
    }

    protected function getUpcomingAppointments()
    {
        if (class_exists('App\Models\Appointment')) {
            return \App\Models\Appointment::with('vehicle')
                ->where('appointment_date', '>=', now())
                ->orderBy('appointment_date', 'asc')
                ->take(5)
                ->get();
        }
        return collect();
    }

    protected function getLowStockParts()
    {
        if (class_exists('App\Models\Part')) {
            return \App\Models\Part::where('stock', '<', 10)
                ->orderBy('stock', 'asc')
                ->take(5)
                ->get();
        }
        return collect();
    }
}
