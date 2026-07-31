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

<x-nav.link route="admin.settings.notification-preferences" icon="adjustments-horizontal">My Notifications</x-nav.link>

<x-nav.divider>{{ __('admin.Modules') }}</x-nav.divider>

@if(can('view_berber_app_dashboard') || can('view_barbers') || can('view_services') || can('view_bookings') || can('view_reminders'))
<x-nav.group label="{{ __('admin.Berber App') }}" icon="scissors" route="admin.berber-app">
    @can('view_berber_app_dashboard')
        <x-nav.link route="admin.berber-app.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan

    <x-nav.link route="front.berber-app" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>

    @can('view_barbers')
        <x-nav.link route="admin.berber-app.barbers.index" icon="user">{{ __('berber-app/barbers.Barbers') }}</x-nav.link>
    @endcan

    @can('view_services')
        <x-nav.link route="admin.berber-app.services.index" icon="tag">{{ __('berber-app/services.Services') }}</x-nav.link>
    @endcan

    @can('view_bookings')
        <x-nav.link route="admin.berber-app.bookings.index" icon="clipboard-document">{{ __('berber-app/bookings.Bookings') }}</x-nav.link>
    @endcan

    @can('view_reminders')
        <x-nav.link route="admin.berber-app.reminders.index" icon="bell">{{ __('berber-app/reminders.Reminders') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_auto_repair_management_dashboard') || can('view_customers') || can('view_vehicle_brands') || can('view_vehicle_models') || can('view_vehicles') || can('view_vehicle_documents') || can('view_employees') || can('view_mechanics') || can('view_job_cards') || can('view_parts') || can('view_inventories') || can('view_job_card_services') || can('view_job_card_parts') || can('view_suppliers') || can('view_purchase_orders') || can('view_purchase_order_items') || can('view_estimates') || can('view_estimate_items') || can('view_invoices') || can('view_invoice_items') || can('view_appointments') || can('view_reports'))
<x-nav.group label="{{ __('admin.Auto Repair Management') }}" icon="rectangle-group" route="admin.auto-repair-management">
    @can('view_auto_repair_management_dashboard')
        <x-nav.link route="admin.auto-repair-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_customers')
        <x-nav.link route="admin.auto-repair-management.customers.index" icon="user">{{ __('auto-repair-management/customers.Customers') }}</x-nav.link>
    @endcan
    @can('view_vehicle_brands')
        <x-nav.link route="admin.auto-repair-management.vehicle-brands.index" icon="tag">{{ __('auto-repair-management/vehicle-brands.VehicleBrands') }}</x-nav.link>
    @endcan
    @can('view_vehicle_models')
        <x-nav.link route="admin.auto-repair-management.vehicle-models.index" icon="tag">{{ __('auto-repair-management/vehicle-models.VehicleModels') }}</x-nav.link>
    @endcan
    @can('view_vehicles')
        <x-nav.link route="admin.auto-repair-management.vehicles.index" icon="truck">{{ __('auto-repair-management/vehicles.Vehicles') }}</x-nav.link>
    @endcan
    @can('view_vehicle_documents')
        <x-nav.link route="admin.auto-repair-management.vehicle-documents.index" icon="document">{{ __('auto-repair-management/vehicle-documents.VehicleDocuments') }}</x-nav.link>
    @endcan
    @can('view_employees')
        <x-nav.link route="admin.auto-repair-management.employees.index" icon="user">{{ __('auto-repair-management/employees.Employees') }}</x-nav.link>
    @endcan
    @can('view_mechanics')
        <x-nav.link route="admin.auto-repair-management.mechanics.index" icon="user">{{ __('auto-repair-management/mechanics.Mechanics') }}</x-nav.link>
    @endcan
    @can('view_job_cards')
        <x-nav.link route="admin.auto-repair-management.job-cards.index" icon="clipboard-document">{{ __('auto-repair-management/job-cards.JobCards') }}</x-nav.link>
    @endcan
    @can('view_services')
        <x-nav.link route="admin.auto-repair-management.services.index" icon="tag">{{ __('auto-repair-management/services.Services') }}</x-nav.link>
    @endcan
    @can('view_parts')
        <x-nav.link route="admin.auto-repair-management.parts.index" icon="tag">{{ __('auto-repair-management/parts.Parts') }}</x-nav.link>
    @endcan
    @can('view_inventories')
        <x-nav.link route="admin.auto-repair-management.inventories.index" icon="archive-box">{{ __('auto-repair-management/inventories.Inventories') }}</x-nav.link>
    @endcan
    @can('view_job_card_services')
        <x-nav.link route="admin.auto-repair-management.job-card-services.index" icon="tag">{{ __('auto-repair-management/job-card-services.JobCardServices') }}</x-nav.link>
    @endcan
    @can('view_job_card_parts')
        <x-nav.link route="admin.auto-repair-management.job-card-parts.index" icon="tag">{{ __('auto-repair-management/job-card-parts.JobCardParts') }}</x-nav.link>
    @endcan
    @can('view_suppliers')
        <x-nav.link route="admin.auto-repair-management.suppliers.index" icon="truck">{{ __('auto-repair-management/suppliers.Suppliers') }}</x-nav.link>
    @endcan
    @can('view_purchase_orders')
        <x-nav.link route="admin.auto-repair-management.purchase-orders.index" icon="clipboard-document">{{ __('auto-repair-management/purchase-orders.PurchaseOrders') }}</x-nav.link>
    @endcan
    @can('view_purchase_order_items')
        <x-nav.link route="admin.auto-repair-management.purchase-order-items.index" icon="clipboard-document">{{ __('auto-repair-management/purchase-order-items.PurchaseOrderItems') }}</x-nav.link>
    @endcan
    @can('view_estimates')
        <x-nav.link route="admin.auto-repair-management.estimates.index" icon="clipboard-document">{{ __('auto-repair-management/estimates.Estimates') }}</x-nav.link>
    @endcan
    @can('view_estimate_items')
        <x-nav.link route="admin.auto-repair-management.estimate-items.index" icon="clipboard-document">{{ __('auto-repair-management/estimate-items.EstimateItems') }}</x-nav.link>
    @endcan
    @can('view_invoices')
        <x-nav.link route="admin.auto-repair-management.invoices.index" icon="clipboard-document">{{ __('auto-repair-management/invoices.Invoices') }}</x-nav.link>
    @endcan
    @can('view_invoice_items')
        <x-nav.link route="admin.auto-repair-management.invoice-items.index" icon="clipboard-document">{{ __('auto-repair-management/invoice-items.InvoiceItems') }}</x-nav.link>
    @endcan
    @can('view_appointments')
        <x-nav.link route="admin.auto-repair-management.appointments.index" icon="calendar">{{ __('auto-repair-management/appointments.Appointments') }}</x-nav.link>
    @endcan
    @can('view_reports')
        <x-nav.link route="admin.auto-repair-management.reports.index" icon="chart-bar">{{ __('auto-repair-management/reports.Reports') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_construction_erp_dashboard') || can('view_ce_employees') || can('view_projects') || can('view_buildings') || can('view_apartments') || can('view_materials') || can('view_progress_reports'))
<x-nav.group label="{{ __('admin.Construction ERP') }}" icon="rectangle-group" route="admin.construction-e-r-p">
    @can('view_construction_erp_dashboard')
        <x-nav.link route="admin.construction-e-r-p.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_ce_employees')
        <x-nav.link route="admin.construction-e-r-p.employees.index" icon="user">{{ __('construction-e-r-p/employees.Employees') }}</x-nav.link>
    @endcan
    @can('view_projects')
        <x-nav.link route="admin.construction-e-r-p.projects.index" icon="building-office">{{ __('construction-e-r-p/projects.Projects') }}</x-nav.link>
    @endcan
    @can('view_buildings')
        <x-nav.link route="admin.construction-e-r-p.buildings.index" icon="building-office">{{ __('construction-e-r-p/buildings.Buildings') }}</x-nav.link>
    @endcan
    @can('view_apartments')
        <x-nav.link route="admin.construction-e-r-p.apartments.index" icon="home">{{ __('construction-e-r-p/apartments.Apartments') }}</x-nav.link>
    @endcan
    @can('view_materials')
        <x-nav.link route="admin.construction-e-r-p.materials.index" icon="archive-box">{{ __('construction-e-r-p/materials.Materials') }}</x-nav.link>
    @endcan
    @can('view_progress_reports')
        <x-nav.link route="admin.construction-e-r-p.progress-reports.index" icon="chart-bar">{{ __('construction-e-r-p/progress-reports.ProgressReports') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_school_management_dashboard') || can('view_guardians') || can('view_teachers') || can('view_school_classes') || can('view_students') || can('view_attendances') || can('view_exams') || can('view_grades'))
<x-nav.group label="{{ __('admin.School Management') }}" icon="rectangle-group" route="admin.school-management">
    @can('view_school_management_dashboard')
        <x-nav.link route="admin.school-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_guardians')
        <x-nav.link route="admin.school-management.guardians.index" icon="user">{{ __('school-management/guardians.Guardians') }}</x-nav.link>
    @endcan
    @can('view_teachers')
        <x-nav.link route="admin.school-management.teachers.index" icon="user">{{ __('school-management/teachers.Teachers') }}</x-nav.link>
    @endcan
    @can('view_school_classes')
        <x-nav.link route="admin.school-management.school-classes.index" icon="academic-cap">{{ __('school-management/school-classes.SchoolClasses') }}</x-nav.link>
    @endcan
    @can('view_students')
        <x-nav.link route="admin.school-management.students.index" icon="user">{{ __('school-management/students.Students') }}</x-nav.link>
    @endcan
    @can('view_attendances')
        <x-nav.link route="admin.school-management.attendances.index" icon="calendar">{{ __('school-management/attendances.Attendances') }}</x-nav.link>
    @endcan
    @can('view_exams')
        <x-nav.link route="admin.school-management.exams.index" icon="clipboard-document">{{ __('school-management/exams.Exams') }}</x-nav.link>
    @endcan
    @can('view_grades')
        <x-nav.link route="admin.school-management.grades.index" icon="chart-bar">{{ __('school-management/grades.Grades') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_categories') || can('view_suppliers') || can('view_customers') || can('view_warehouses') || can('view_products') || can('view_purchase_orders') || can('view_sales') || can('view_stock_transfers'))
<x-nav.group label="{{ __('admin.Warehouse Management') }}" icon="rectangle-group" route="admin.warehouse-management">
    @can('view_categories')
        <x-nav.link route="admin.warehouse-management.categories.index" icon="tag">{{ __('warehouse-management/categories.Categories') }}</x-nav.link>
    @endcan
    @can('view_suppliers')
        <x-nav.link route="admin.warehouse-management.suppliers.index" icon="truck">{{ __('warehouse-management/suppliers.Suppliers') }}</x-nav.link>
    @endcan
    @can('view_customers')
        <x-nav.link route="admin.warehouse-management.customers.index" icon="user">{{ __('warehouse-management/customers.Customers') }}</x-nav.link>
    @endcan
    @can('view_warehouses')
        <x-nav.link route="admin.warehouse-management.warehouses.index" icon="building-office">{{ __('warehouse-management/warehouses.Warehouses') }}</x-nav.link>
    @endcan
    @can('view_products')
        <x-nav.link route="admin.warehouse-management.products.index" icon="archive-box">{{ __('warehouse-management/products.Products') }}</x-nav.link>
    @endcan
    @can('view_purchase_orders')
        <x-nav.link route="admin.warehouse-management.purchase-orders.index" icon="clipboard-document">{{ __('warehouse-management/purchase-orders.PurchaseOrders') }}</x-nav.link>
    @endcan
    @can('view_sales')
        <x-nav.link route="admin.warehouse-management.sales.index" icon="banknotes">{{ __('warehouse-management/sales.Sales') }}</x-nav.link>
    @endcan
    @can('view_stock_transfers')
        <x-nav.link route="admin.warehouse-management.stock-transfers.index" icon="arrows-right-left">{{ __('warehouse-management/stock-transfers.StockTransfers') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_doctors') || can('view_patients') || can('view_visits') || can('view_prescriptions') || can('view_clinic_invoices'))
<x-nav.group label="{{ __('admin.Clinic Management') }}" icon="rectangle-group" route="admin.clinic-management">
    @can('view_doctors')
        <x-nav.link route="admin.clinic-management.doctors.index" icon="user">{{ __('clinic-management/doctors.Doctors') }}</x-nav.link>
    @endcan
    @can('view_patients')
        <x-nav.link route="admin.clinic-management.patients.index" icon="user">{{ __('clinic-management/patients.Patients') }}</x-nav.link>
    @endcan
    @can('view_visits')
        <x-nav.link route="admin.clinic-management.visits.index" icon="clipboard-document">{{ __('clinic-management/visits.Visits') }}</x-nav.link>
    @endcan
    @can('view_prescriptions')
        <x-nav.link route="admin.clinic-management.prescriptions.index" icon="document">{{ __('clinic-management/prescriptions.Prescriptions') }}</x-nav.link>
    @endcan
    @can('view_clinic_invoices')
        <x-nav.link route="admin.clinic-management.clinic-invoices.index" icon="clipboard-document">{{ __('clinic-management/clinic-invoices.ClinicInvoices') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_waiters') || can('view_dining_tables') || can('view_menu_items') || can('view_orders') || can('view_order_items') || can('view_payments'))
<x-nav.group label="{{ __('admin.Restaurant POS') }}" icon="rectangle-group" route="admin.restaurant-p-o-s">
    @can('view_waiters')
        <x-nav.link route="admin.restaurant-p-o-s.waiters.index" icon="user">{{ __('restaurant-p-o-s/waiters.Waiters') }}</x-nav.link>
    @endcan
    @can('view_dining_tables')
        <x-nav.link route="admin.restaurant-p-o-s.dining-tables.index" icon="squares-2x2">{{ __('restaurant-p-o-s/dining-tables.DiningTables') }}</x-nav.link>
    @endcan
    @can('view_menu_items')
        <x-nav.link route="admin.restaurant-p-o-s.menu-items.index" icon="tag">{{ __('restaurant-p-o-s/menu-items.MenuItems') }}</x-nav.link>
    @endcan
    @can('view_orders')
        <x-nav.link route="admin.restaurant-p-o-s.orders.index" icon="clipboard-document">{{ __('restaurant-p-o-s/orders.Orders') }}</x-nav.link>
    @endcan
    @can('view_order_items')
        <x-nav.link route="admin.restaurant-p-o-s.order-items.index" icon="tag">{{ __('restaurant-p-o-s/order-items.OrderItems') }}</x-nav.link>
    @endcan
    @can('view_payments')
        <x-nav.link route="admin.restaurant-p-o-s.payments.index" icon="banknotes">{{ __('restaurant-p-o-s/payments.Payments') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_owners') || can('view_agents') || can('view_clients') || can('view_properties') || can('view_property_visits') || can('view_contracts'))
<x-nav.group label="{{ __('admin.Real Estate CRM') }}" icon="rectangle-group" route="admin.real-estate-c-r-m">
    @can('view_owners')
        <x-nav.link route="admin.real-estate-c-r-m.owners.index" icon="user">{{ __('real-estate-c-r-m/owners.Owners') }}</x-nav.link>
    @endcan
    @can('view_agents')
        <x-nav.link route="admin.real-estate-c-r-m.agents.index" icon="user">{{ __('real-estate-c-r-m/agents.Agents') }}</x-nav.link>
    @endcan
    @can('view_clients')
        <x-nav.link route="admin.real-estate-c-r-m.clients.index" icon="user">{{ __('real-estate-c-r-m/clients.Clients') }}</x-nav.link>
    @endcan
    @can('view_properties')
        <x-nav.link route="admin.real-estate-c-r-m.properties.index" icon="home">{{ __('real-estate-c-r-m/properties.Properties') }}</x-nav.link>
    @endcan
    @can('view_property_visits')
        <x-nav.link route="admin.real-estate-c-r-m.property-visits.index" icon="calendar">{{ __('real-estate-c-r-m/property-visits.PropertyVisits') }}</x-nav.link>
    @endcan
    @can('view_contracts')
        <x-nav.link route="admin.real-estate-c-r-m.contracts.index" icon="document">{{ __('real-estate-c-r-m/contracts.Contracts') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

@if(can('view_companies') || can('view_contacts') || can('view_leads') || can('view_deals') || can('view_tasks'))
<x-nav.group label="{{ __('admin.CRM') }}" icon="rectangle-group" route="admin.c-r-m">
    @can('view_companies')
        <x-nav.link route="admin.c-r-m.companies.index" icon="building-office">{{ __('c-r-m/companies.Companies') }}</x-nav.link>
    @endcan
    @can('view_contacts')
        <x-nav.link route="admin.c-r-m.contacts.index" icon="user">{{ __('c-r-m/contacts.Contacts') }}</x-nav.link>
    @endcan
    @can('view_leads')
        <x-nav.link route="admin.c-r-m.leads.index" icon="tag">{{ __('c-r-m/leads.Leads') }}</x-nav.link>
    @endcan
    @can('view_deals')
        <x-nav.link route="admin.c-r-m.deals.index" icon="chart-bar">{{ __('c-r-m/deals.Deals') }}</x-nav.link>
    @endcan
    @can('view_tasks')
        <x-nav.link route="admin.c-r-m.tasks.index" icon="clipboard-document">{{ __('c-r-m/tasks.Tasks') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

<x-nav.divider>{{ __('admin.Account') }}</x-nav.divider>

@can('view_users')
    <x-nav.link route="admin.users.index" icon="users">{{ __('admin.Users') }}</x-nav.link>
@endcan
