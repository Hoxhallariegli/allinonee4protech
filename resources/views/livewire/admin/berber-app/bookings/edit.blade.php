<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('berber-app/bookings.Edit Booking') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('berber-app/bookings.Update info') }}</x-short-description></div><x-back-btn route="admin.berber-app.bookings.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700">
        <form wire:submit.prevent="update" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div>
                    <div class="flex items-end gap-2">
                        <div class="flex-1"><x-form.dropdown-search name="barber_id" wire:model.live="barber_id" :label="__('berber-app/bookings.Barber Id')" :data="$barbers" /></div>
                        <x-modal>
                            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="size-5" /></button></x-slot>
                            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Barber</div></x-slot>
                            <x-slot name="content"><livewire:admin.berber-app.barbers.quick-create /></x-slot>
                        </x-modal>
                    </div>
                </div>
                <div>
                    <div class="flex items-end gap-2">
                        <div class="flex-1"><x-form.dropdown-search name="service_id" wire:model.live="service_id" :label="__('berber-app/bookings.Service Id')" :data="$services" /></div>
                        <x-modal>
                            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="size-5" /></button></x-slot>
                            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Service</div></x-slot>
                            <x-slot name="content"><livewire:admin.berber-app.services.quick-create /></x-slot>
                        </x-modal>
                    </div>
                </div>
                <div>
                    <div class="flex items-end gap-2">
                        <div class="flex-1"><x-form.dropdown-search name="customer_id" wire:model.live="customer_id" :label="__('berber-app/bookings.Customer')" :data="$customers" /></div>
                        <x-modal>
                            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="size-5" /></button></x-slot>
                            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Customer</div></x-slot>
                            <x-slot name="content"><livewire:admin.berber-app.customers.quick-create /></x-slot>
                        </x-modal>
                    </div>
                </div>
                <div class="hidden">
                    <x-form.input name="customer_name" type="text" wire:model="customer_name" />
                    <x-form.input name="customer_phone" type="text" wire:model="customer_phone" />
                </div>
                <div><x-form.input name="appointment_datetime" type="datetime-local" wire:model="appointment_datetime" :label="__('berber-app/bookings.Appointment Datetime')" class="dark:bg-gray-900" /></div>
                <div>
                    <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('berber-app/bookings.Status') }}</label>
                    <select name="status" wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl">
                        <option value="pending">pending</option>
                        <option value="confirmed">confirmed</option>
                        <option value="cancelled">cancelled</option>
                        <option value="completed">completed</option>
                    </select>
                </div>
                <div><x-form.checkbox name="reminder_enabled" wire:model="reminder_enabled" :label="__('berber-app/bookings.Reminder Enabled')" /></div>
                <div><x-form.input name="reminder_minutes" type="text" wire:model="reminder_minutes" :label="__('berber-app/bookings.Reminder Minutes')" class="dark:bg-gray-900" /></div>
                <div class="md:col-span-2"><x-form.input name="cancel_reason" type="text" wire:model="cancel_reason" :label="__('berber-app/bookings.Cancel Reason')" class="dark:bg-gray-900" /></div>
            </div>
            <div class="mt-10 flex justify-end">
                <x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('berber-app/bookings.Update') }}</x-button>
            </div>
        </form>
    </div>
</div>
