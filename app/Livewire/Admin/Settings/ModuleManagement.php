<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Module;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Module Management')]
class ModuleManagement extends Component
{
    public function toggleModule($id)
    {
        $module = Module::findOrFail($id);
        $module->is_active = !$module->is_active;
        $module->save();

        $status = $module->is_active ? 'enabled' : 'disabled';
        $this->dispatch('toast', message: "Module {$module->label} has been {$status}.", type: 'success');
    }

    public function render()
    {
        abort_if_cannot('view_system_settings');

        return view('livewire.admin.settings.module-management', [
            'modules' => Module::orderBy('order')->get()
        ])->layout('components.layouts.app');
    }
}
