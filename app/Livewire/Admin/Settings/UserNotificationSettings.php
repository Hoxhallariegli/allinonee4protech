<?php

namespace App\Livewire\Admin\Settings;

use App\Models\NotificationSetting;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Notification Preferences')]
class UserNotificationSettings extends Component
{
    public $settings = [];
    public $modules = [
        'BerberApp' => [
            'booking_created' => 'New Reservation',
            'reminder' => 'Appointment Reminders'
        ],
        'AutoRepairManagement' => [
            'created' => 'New Service Record',
            'reminder' => 'Service Reminders'
        ],
        'ConstructionERP' => [
            'created' => 'Project Updates',
            'reminder' => 'Deadline Reminders'
        ],
        'SchoolManagement' => [
            'created' => 'New Attendance/Grade',
            'reminder' => 'Exam Reminders'
        ],
        'WarehouseManagement' => [
            'created' => 'Stock Movement',
            'reminder' => 'Low Stock Alerts'
        ],
        'ClinicManagement' => [
            'created' => 'New Visit/Patient',
            'reminder' => 'Patient Reminders'
        ],
        'RestaurantPOS' => [
            'created' => 'New Order',
            'reminder' => 'Preparation Alerts'
        ],
        'RealEstateCRM' => [
            'created' => 'New Lead/Property',
            'reminder' => 'Visit Reminders'
        ],
        'CRM' => [
            'created' => 'New Deal/Contact',
            'reminder' => 'Task Reminders'
        ]
    ];

    public function mount()
    {
        foreach ($this->modules as $module => $events) {
            foreach ($events as $event => $label) {
                $enabled = NotificationSetting::where('user_id', auth()->id())
                    ->where('module', $module)
                    ->where('event_type', $event)
                    ->value('enabled');

                $this->settings[$module][$event] = ($enabled === null) ? true : (bool) $enabled;
            }
        }
    }

    public function toggle($module, $event)
    {
        $current = $this->settings[$module][$event];
        NotificationSetting::updateOrCreate(
            ['user_id' => auth()->id(), 'module' => $module, 'event_type' => $event],
            ['enabled' => !$current]
        );
        $this->settings[$module][$event] = !$current;
        $this->dispatch('toast', message: 'Preferences updated.', type: 'success');
    }

    public function render()
    {
        return view('livewire.admin.settings.user-notification-settings')->layout('components.layouts.app');
    }
}
