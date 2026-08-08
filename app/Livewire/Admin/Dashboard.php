<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Module;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render(): View
    {
        $moduleSettings = [
            'berber-app' => ['icon' => 'scissors', 'color' => 'blue'],
            'clinic-management' => ['icon' => 'heart', 'color' => 'rose'],
            'auto-repair-management' => ['icon' => 'wrench', 'color' => 'amber'],
            'construction-e-r-p' => ['icon' => 'building-office-2', 'color' => 'emerald'],
            'warehouse-management' => ['icon' => 'archive-box', 'color' => 'indigo'],
            'restaurant-p-o-s' => ['icon' => 'cake', 'color' => 'orange'],
            'school-management' => ['icon' => 'academic-cap', 'color' => 'cyan'],
            'real-estate-c-r-m' => ['icon' => 'home-modern', 'color' => 'teal'],
            'c-r-m' => ['icon' => 'user-group', 'color' => 'violet'],
            'hotel-management' => ['icon' => 'home-modern', 'color' => 'rose'],
            'human-resources' => ['icon' => 'users', 'color' => 'blue'],
            'e--commerce' => ['icon' => 'shopping-cart', 'color' => 'pink'],
            'fleet-management' => ['icon' => 'truck', 'color' => 'slate'],
            'gym-management' => ['icon' => 'bolt', 'color' => 'yellow'],
            'finance' => ['icon' => 'banknotes', 'color' => 'emerald'],
            'legal-management' => ['icon' => 'scale', 'color' => 'slate'],
            'pharmacy-management' => ['icon' => 'beaker', 'color' => 'green'],
            'event-management' => ['icon' => 'sparkles', 'color' => 'purple'],
            'travel-agency' => ['icon' => 'globe-alt', 'color' => 'sky'],
            'facility-management' => ['icon' => 'wrench-screwdriver', 'color' => 'stone'],
            'agriculture-management' => ['icon' => 'sun', 'color' => 'lime'],
        ];

        $modules = Module::where('is_active', true)->orderBy('order')->get()->map(function($module) use ($moduleSettings) {
            $settings = $moduleSettings[$module->key] ?? ['icon' => 'rectangle-group', 'color' => 'indigo'];

            $module->ui_icon = $settings['icon'];
            $module->ui_color = $settings['color'];
            $desc = __("admin.module_desc_{$module->key}");
            $module->ui_description = is_string($desc) ? $desc : '';

            // Route handling
            $module->admin_route = \Illuminate\Support\Facades\Route::has("admin.{$module->key}.dashboard")
                ? route("admin.{$module->key}.dashboard")
                : (\Illuminate\Support\Facades\Route::has("modular.{$module->key}.admin.{$module->key}.dashboard")
                    ? route("modular.{$module->key}.admin.{$module->key}.dashboard")
                    : "#");

            $module->front_route = \Illuminate\Support\Facades\Route::has("front.{$module->key}")
                ? route("front.{$module->key}")
                : "#";

            return $module;
        });

        return view('livewire.admin.dashboard', [
            'modules' => $modules
        ]);
    }
}
