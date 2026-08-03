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
        if ($request->is('modular/*')) {
            $group = $request->segment(2); // e.g., 'berber-app'

            // This is the Magic: We override the layout for ANY Livewire component
            // called within this request lifecycle.
            config(['livewire.layout' => "components.layouts.groups.{$group}"]);
        }

        return $next($request);
    }
}
