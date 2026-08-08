<?php

namespace App\Livewire\Admin\GymManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('GymManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['classSchedules'] = collect(range(6, 0))->map(fn($i) => \App\Models\GymManagement\ClassSchedule::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['members'] = collect(range(6, 0))->map(fn($i) => \App\Models\GymManagement\Member::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['membershipPlans'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\GymManagement\MembershipPlan::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['subscriptions'] = collect(range(6, 0))->map(fn($i) => \App\Models\GymManagement\Subscription::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['trainers'] = collect(range(6, 0))->map(fn($i) => \App\Models\GymManagement\Trainer::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.gym-management.dashboard', [
            'stats' => [
            'classSchedules' => \App\Models\GymManagement\ClassSchedule::count(),
            'members' => \App\Models\GymManagement\Member::count(),
            'membershipPlans' => \App\Models\GymManagement\MembershipPlan::count(),
            'membershipPlans_sum' => (float) \App\Models\GymManagement\MembershipPlan::sum('price'),
            'subscriptions' => \App\Models\GymManagement\Subscription::count(),
            'trainers' => \App\Models\GymManagement\Trainer::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}