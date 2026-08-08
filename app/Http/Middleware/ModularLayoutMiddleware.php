<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Symfony\Component\HttpFoundation\Response;

class ModularLayoutMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        $modules = [
            'berber-app', 'clinic-management', 'auto-repair-management', 'construction-e-r-p',
            'warehouse-management', 'restaurant-p-o-s', 'school-management', 'real-estate-c-r-m',
            'c-r-m', 'hotel-management', 'human-resources', 'e--commerce', 'fleet-management',
            'gym-management', 'finance', 'legal-management', 'pharmacy-management',
            'event-management', 'travel-agency', 'facility-management', 'agriculture-management'
        ];

        foreach ($modules as $module) {
            if (str_contains($path, $module)) {
                // Since our base app layout is now self-transforming, we just force it.
                config(['livewire.layout' => 'components.layouts.app']);
                break;
            }
        }

        return $next($request);
    }
}
