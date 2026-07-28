@can('view_dashboard')
    <x-nav.link route="dashboard" icon="home">{{ __('admin.Dashboard') }}</x-nav.link>
@endcan

@if(can('view_system_settings') || can('view_roles') || can('view_audit_trails'))
    <x-nav.divider>{{ __('admin.Settings') }}</x-nav.divider>
@endif

@can('view_audit_trails')
    <x-nav.link route="admin.settings.audit-trails.index" icon="identification">{{ __('admin.Audit Trails') }}</x-nav.link>
@endcan

@can('view_roles')
    <x-nav.link route="admin.settings.roles.index" icon="archive-box">{{ __('admin.Roles') }}</x-nav.link>
@endcan

@can('view_system_settings')
    <x-nav.link route="admin.settings" icon="wrench-screwdriver">{{ __('admin.System Settings') }}</x-nav.link>
@endcan

@can('view_system_settings')
    <x-nav.link route="admin.settings.ai-assistant" icon="cpu-chip">{{ __('AI Assistant') }}</x-nav.link>
@endcan

@can('view_system_settings')
    <x-nav.link route="admin.settings.languages.index" icon="language">{{ __('admin.Languages') }}</x-nav.link>
@endcan

@can('view_system_settings')
    <x-nav.link route="admin.settings.notifications" icon="bell">{{ __('admin.Notifications') }}</x-nav.link>
@endcan

<x-nav.divider>{{ __('admin.Modules') }}</x-nav.divider>


























































































@can('view_customers')
    <x-nav.link route="admin.customers.index" icon="user">{{ __('customers.Customers') }}</x-nav.link>
@endcan

@can('view_vehicle_brands')
    <x-nav.link route="admin.vehicle-brands.index" icon="tag">{{ __('vehicle-brands.VehicleBrands') }}</x-nav.link>
@endcan

@can('view_vehicle_models')
    <x-nav.link route="admin.vehicle-models.index" icon="tag">{{ __('vehicle-models.VehicleModels') }}</x-nav.link>
@endcan

@can('view_vehicles')
    <x-nav.link route="admin.vehicles.index" icon="truck">{{ __('vehicles.Vehicles') }}</x-nav.link>
@endcan

@can('view_vehicle_documents')
    <x-nav.link route="admin.vehicle-documents.index" icon="document">{{ __('vehicle-documents.VehicleDocuments') }}</x-nav.link>
@endcan

@can('view_employees')
    <x-nav.link route="admin.employees.index" icon="user">{{ __('employees.Employees') }}</x-nav.link>
@endcan

@can('view_mechanics')
    <x-nav.link route="admin.mechanics.index" icon="user">{{ __('mechanics.Mechanics') }}</x-nav.link>
@endcan

@can('view_job_cards')
    <x-nav.link route="admin.job-cards.index" icon="clipboard-document">{{ __('job-cards.JobCards') }}</x-nav.link>
@endcan

@can('view_services')
    <x-nav.link route="admin.services.index" icon="tag">{{ __('services.Services') }}</x-nav.link>
@endcan

@can('view_parts')
    <x-nav.link route="admin.parts.index" icon="tag">{{ __('parts.Parts') }}</x-nav.link>
@endcan

@can('view_job_card_services')
    <x-nav.link route="admin.job-card-services.index" icon="tag">{{ __('job-card-services.JobCardServices') }}</x-nav.link>
@endcan

@can('view_job_card_parts')
    <x-nav.link route="admin.job-card-parts.index" icon="tag">{{ __('job-card-parts.JobCardParts') }}</x-nav.link>
@endcan

@can('view_inventories')
    <x-nav.link route="admin.inventories.index" icon="archive-box">{{ __('inventories.Inventories') }}</x-nav.link>
@endcan

@can('view_suppliers')
    <x-nav.link route="admin.suppliers.index" icon="user">{{ __('suppliers.Suppliers') }}</x-nav.link>
@endcan

@can('view_purchase_orders')
    <x-nav.link route="admin.purchase-orders.index" icon="clipboard-document">{{ __('purchase-orders.PurchaseOrders') }}</x-nav.link>
@endcan

@can('view_purchase_order_items')
    <x-nav.link route="admin.purchase-order-items.index" icon="tag">{{ __('purchase-order-items.PurchaseOrderItems') }}</x-nav.link>
@endcan

@can('view_estimates')
    <x-nav.link route="admin.estimates.index" icon="clipboard-document">{{ __('estimates.Estimates') }}</x-nav.link>
@endcan

@can('view_estimate_items')
    <x-nav.link route="admin.estimate-items.index" icon="tag">{{ __('estimate-items.EstimateItems') }}</x-nav.link>
@endcan

@can('view_invoices')
    <x-nav.link route="admin.invoices.index" icon="clipboard-document">{{ __('invoices.Invoices') }}</x-nav.link>
@endcan

@can('view_invoice_items')
    <x-nav.link route="admin.invoice-items.index" icon="tag">{{ __('invoice-items.InvoiceItems') }}</x-nav.link>
@endcan

@can('view_appointments')
    <x-nav.link route="admin.appointments.index" icon="calendar">{{ __('appointments.Appointments') }}</x-nav.link>
@endcan

@can('view_reports')
    <x-nav.link route="admin.reports.index" icon="chart-bar">{{ __('reports.Reports') }}</x-nav.link>
@endcan
<x-nav.divider>{{ __('admin.Account') }}</x-nav.divider>

@can('view_users')
    <x-nav.link route="admin.users.index" icon="users">{{ __('admin.Users') }}</x-nav.link>
@endcan
