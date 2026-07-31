<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('berber/bookings.Edit Booking') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('berber/bookings.Update info') }}</x-short-description></div><x-back-btn route="admin.berber.bookings.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700">
        <form wire:submit.prevent="update" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div><x-form.dropdown-search name="barber_id" wire:model="barber_id" :label="__('berber/bookings.Barber')" :data="$barbers" /></div>
                <div><x-form.dropdown-search name="service_id" wire:model="service_id" :label="__('berber/bookings.Service')" :data="$services" /></div>
                <div><x-form.input name="customer_name" wire:model="customer_name" :label="__('berber/bookings.Client Name')" class="dark:bg-gray-900" /></div>
                <div><x-form.input name="customer_phone" wire:model="customer_phone" :label="__('berber/bookings.Phone')" class="dark:bg-gray-900" /></div>
                <div><x-form.input name="appointment_datetime" type="datetime-local" wire:model="appointment_datetime" :label="__('berber/bookings.Date/Time')" class="dark:bg-gray-900" /></div>
                <div>
                    <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('berber/bookings.Status') }}</label>
                    <select wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div><x-form.checkbox name="reminder_enabled" wire:model="reminder_enabled" :label="__('berber/bookings.Reminder Enabled')" /></div>
                <div><x-form.input name="reminder_minutes" type="number" wire:model="reminder_minutes" :label="__('berber/bookings.Reminder Minutes')" class="dark:bg-gray-900" /></div>
            </div>
            <div class="mt-10 flex justify-end">
                <x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('berber/bookings.Update') }}</x-button>
            </div>
        </form>
    </div>
</div>
