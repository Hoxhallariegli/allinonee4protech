<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

#[Title('Welcome - E4ProTech Ecosystem')]
class Welcome extends Component
{
    public function getModulesProperty()
    {
        $adminPath = base_path('routes/admin');
        $modules = [];

        if (File::isDirectory($adminPath)) {
            $directories = File::directories($adminPath);

            foreach ($directories as $dir) {
                $key = basename($dir);

                // Skip some specific keys if needed
                if ($key === 'settings') continue;

                $modules[] = [
                    'key' => $key,
                    'name' => Str::title(str_replace('-', ' ', $key)),
                    'url' => url("/modular/{$key}"),
                    'icon' => $this->getIcon($key),
                    'description' => $this->getDescription($key),
                    'color' => $this->getColor($key),
                ];
            }
        }

        return $modules;
    }

    private function getIcon($key)
    {
        return match ($key) {
            'berber-app' => 'scissors',
            'auto-repair-management' => 'wrench-screwdriver',
            'construction-erp' => 'building-office-2',
            'school-management' => 'academic-cap',
            'warehouse-management' => 'archive-box',
            'clinic-management' => 'heart',
            'restaurant-pos' => 'shopping-cart',
            'real-estate-crm' => 'home-modern',
            'crm' => 'users',
            default => 'rectangle-group',
        };
    }

    private function getDescription($key)
    {
        return __("admin.module_desc_{$key}");
    }

    /**
     * Returns a hex color per module so it can be injected as a CSS custom
     * property (--accent) in the view. Tailwind's JIT purges classes it
     * cannot see at build time, so string-interpolated utility classes like
     * `bg-{{ $color }}-500` are unreliable and were silently breaking.
     * Using real hex values sidesteps that entirely.
     */
    private function getColor($key)
    {
        return match ($key) {
            'berber-app' => '#F59E0B',                // amber
            'auto-repair-management' => '#3B82F6',     // blue
            'construction-erp' => '#10B981',           // emerald
            'school-management' => '#6366F1',          // indigo
            'warehouse-management' => '#F97316',       // orange
            'clinic-management' => '#F43F5E',          // rose
            'restaurant-pos' => '#14B8A6',             // teal
            'real-estate-crm' => '#8B5CF6',            // violet
            'crm' => '#06B6D4',                        // cyan
            default => '#6366F1',
        };
    }

    public function render()
    {
        return view('livewire.public.welcome', [
            'modules' => $this->modules,
        ])->layout('components.layouts.front');
    }
}
