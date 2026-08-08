@can('view_dashboard')
    <x-nav.link route="dashboard" icon="home">{{ __('admin.Dashboard') }}</x-nav.link>
@endcan

<x-nav.divider>{{ __('admin.Modules') }}</x-nav.divider>

{{-- MODULAR GROUPS START --}}
@if(\App\Models\Module::isActive('legal-management') && (can('view_legal_management_dashboard') || can('view_hearings') || can('view_documents') || can('view_billings') || can('view_clients') || can('view_legal_cases')))
<x-nav.group label="{{ __('admin.Legal Management') }}" icon="rectangle-group" route="admin.legal-management">
    <x-nav.link route="front.legal-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_hearings')
        <x-nav.link route="admin.legal-management.hearings.index" icon="calendar">{{ __('legal-management/hearings.Hearings') }}</x-nav.link>
    @endcan

    @can('view_documents')
        <x-nav.link route="admin.legal-management.documents.index" icon="document">{{ __('legal-management/documents.Documents') }}</x-nav.link>
    @endcan

    @can('view_billings')
        <x-nav.link route="admin.legal-management.billings.index" icon="banknotes">{{ __('legal-management/billings.Billings') }}</x-nav.link>
    @endcan

    @can('view_clients')
        <x-nav.link route="admin.legal-management.clients.index" icon="user">{{ __('legal-management/clients.Clients') }}</x-nav.link>
    @endcan

    @can('view_legal_cases')
        <x-nav.link route="admin.legal-management.legal-cases.index" icon="scale">{{ __('legal-management/legal-cases.LegalCases') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif
{{-- 1. Berber App --}}
@if(\App\Models\Module::isActive('berber-app') && (can('view_berber_app_dashboard') || can('view_barbers') || can('view_bookings') || can('view_customers') || can('view_services') || can('view_payments') || can('view_reminders') || can('view_device_tokens')))
<x-nav.group label="{{ __('admin.Berber App') }}" icon="scissors" route="admin.berber-app.dashboard">
    @can('view_berber_app_dashboard')
        <x-nav.link route="admin.berber-app.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    <x-nav.link route="front.berber-app" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_barbers')
        <x-nav.link route="admin.berber-app.barbers.index" icon="user">{{ __('berber-app/barbers.Barbers') }}</x-nav.link>
    @endcan
    @can('view_bookings')
        <x-nav.link route="admin.berber-app.bookings.index" icon="calendar">{{ __('berber-app/bookings.Bookings') }}</x-nav.link>
    @endcan
    @can('view_customers')
        <x-nav.link route="admin.berber-app.customers.index" icon="users">{{ __('berber-app/customers.Customers') }}</x-nav.link>
    @endcan
    @can('view_services')
        <x-nav.link route="admin.berber-app.services.index" icon="tag">{{ __('berber-app/services.Services') }}</x-nav.link>
    @endcan
    @can('view_payments')
        <x-nav.link route="admin.berber-app.payments.index" icon="banknotes">{{ __('berber-app/payments.Payments') }}</x-nav.link>
    @endcan
    @can('view_reminders')
        <x-nav.link route="admin.berber-app.reminders.index" icon="bell">{{ __('berber-app/reminders.Reminders') }}</x-nav.link>
    @endcan
    @can('view_device_tokens')
        <x-nav.link route="admin.berber-app.device-tokens.index" icon="phone">{{ __('berber-app/device-tokens.DeviceTokens') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 2. Auto Repair Management --}}
@if(\App\Models\Module::isActive('auto-repair-management') && (can('view_auto_repair_management_dashboard') || can('view_vehicles') || can('view_job_cards')))
<x-nav.group label="{{ __('admin.Auto Repair Management') }}" icon="wrench" route="admin.auto-repair-management">
    <x-nav.link route="front.auto-repair-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_auto_repair_management_dashboard')
        <x-nav.link route="admin.auto-repair-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_vehicles')
        <x-nav.link route="admin.auto-repair-management.vehicles.index" icon="truck">{{ __('auto-repair-management/vehicles.Vehicles') }}</x-nav.link>
    @endcan
    @can('view_job_cards')
        <x-nav.link route="admin.auto-repair-management.job-cards.index" icon="clipboard-document">{{ __('auto-repair-management/job-cards.JobCards') }}</x-nav.link>
    @endcan
    @can('view_customers')
        <x-nav.link route="admin.auto-repair-management.customers.index" icon="user-group">{{ __('auto-repair-management/customers.Customers') }}</x-nav.link>
    @endcan
    @can('view_mechanics')
        <x-nav.link route="admin.auto-repair-management.mechanics.index" icon="identification">{{ __('auto-repair-management/mechanics.Mechanics') }}</x-nav.link>
    @endcan
    @can('view_employees')
        <x-nav.link route="admin.auto-repair-management.employees.index" icon="users">{{ __('auto-repair-management/employees.Employees') }}</x-nav.link>
    @endcan
    @can('view_services')
        <x-nav.link route="admin.auto-repair-management.services.index" icon="tag">{{ __('auto-repair-management/services.Services') }}</x-nav.link>
    @endcan
    @can('view_parts')
        <x-nav.link route="admin.auto-repair-management.parts.index" icon="cog">{{ __('auto-repair-management/parts.Parts') }}</x-nav.link>
    @endcan
    @can('view_inventories')
        <x-nav.link route="admin.auto-repair-management.inventories.index" icon="archive-box">{{ __('auto-repair-management/inventories.Inventories') }}</x-nav.link>
    @endcan
    @can('view_appointments')
        <x-nav.link route="admin.auto-repair-management.appointments.index" icon="calendar">{{ __('auto-repair-management/appointments.Appointments') }}</x-nav.link>
    @endcan
    @can('view_invoices')
        <x-nav.link route="admin.auto-repair-management.invoices.index" icon="document-text">{{ __('auto-repair-management/invoices.Invoices') }}</x-nav.link>
    @endcan
    @can('view_insurance_claims')
        <x-nav.link route="admin.auto-repair-management.insurance-claims.index" icon="shield-check">{{ __('auto-repair-management/insurance-claims.InsuranceClaims') }}</x-nav.link>
    @endcan
    @can('view_expense_trackings')
        <x-nav.link route="admin.auto-repair-management.expense-trackings.index" icon="receipt-refund">{{ __('auto-repair-management/expense-trackings.ExpenseTrackings') }}</x-nav.link>
    @endcan

    @can('view_vehicle_brands')
        <x-nav.link route="admin.auto-repair-management.vehicle-brands.index" icon="tag">{{ __('auto-repair-management/vehicle-brands.VehicleBrands') }}</x-nav.link>
    @endcan

    @can('view_vehicle_models')
        <x-nav.link route="admin.auto-repair-management.vehicle-models.index" icon="tag">{{ __('auto-repair-management/vehicle-models.VehicleModels') }}</x-nav.link>
    @endcan

    @can('view_vehicle_documents')
        <x-nav.link route="admin.auto-repair-management.vehicle-documents.index" icon="document">{{ __('auto-repair-management/vehicle-documents.VehicleDocuments') }}</x-nav.link>
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

    @can('view_invoice_items')
        <x-nav.link route="admin.auto-repair-management.invoice-items.index" icon="clipboard-document">{{ __('auto-repair-management/invoice-items.InvoiceItems') }}</x-nav.link>
    @endcan

    @can('view_reports')
        <x-nav.link route="admin.auto-repair-management.reports.index" icon="chart-bar">{{ __('auto-repair-management/reports.Reports') }}</x-nav.link>
    @endcan

    @can('view_customer_addresses')
        <x-nav.link route="admin.auto-repair-management.customer-addresses.index" icon="map-pin">{{ __('auto-repair-management/customer-addresses.CustomerAddresses') }}</x-nav.link>
    @endcan

    @can('view_payments')
        <x-nav.link route="admin.auto-repair-management.payments.index" icon="banknotes">{{ __('auto-repair-management/payments.Payments') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 3. Construction ERP --}}
@if(\App\Models\Module::isActive('construction-e-r-p') && (can('view_construction_e_r_p_dashboard') || can('view_projects')))
<x-nav.group label="{{ __('admin.Construction ERP') }}" icon="building-office-2" route="admin.construction-e-r-p">
    <x-nav.link route="front.construction-e-r-p" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_construction_e_r_p_dashboard')
        <x-nav.link route="admin.construction-e-r-p.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_projects')
        <x-nav.link route="admin.construction-e-r-p.projects.index" icon="briefcase">{{ __('construction-e-r-p/projects.Projects') }}</x-nav.link>
    @endcan
    @can('view_buildings')
        <x-nav.link route="admin.construction-e-r-p.buildings.index" icon="building-office">{{ __('construction-e-r-p/buildings.Buildings') }}</x-nav.link>
    @endcan
    @can('view_apartments')
        <x-nav.link route="admin.construction-e-r-p.apartments.index" icon="home">{{ __('construction-e-r-p/apartments.Apartments') }}</x-nav.link>
    @endcan
    @can('view_materials')
        <x-nav.link route="admin.construction-e-r-p.materials.index" icon="cube">{{ __('construction-e-r-p/materials.Materials') }}</x-nav.link>
    @endcan
    @can('view_clients')
        <x-nav.link route="admin.construction-e-r-p.clients.index" icon="user-group">{{ __('construction-e-r-p/clients.Clients') }}</x-nav.link>
    @endcan
    @can('view_contracts')
        <x-nav.link route="admin.construction-e-r-p.contracts.index" icon="document-text">{{ __('construction-e-r-p/contracts.Contracts') }}</x-nav.link>
    @endcan
    @can('view_subcontractors')
        <x-nav.link route="admin.construction-e-r-p.subcontractors.index" icon="user-plus">{{ __('construction-e-r-p/subcontractors.Subcontractors') }}</x-nav.link>
    @endcan
    @can('view_heavy_machineries')
        <x-nav.link route="admin.construction-e-r-p.heavy-machineries.index" icon="truck">{{ __('construction-e-r-p/heavy-machineries.HeavyMachineries') }}</x-nav.link>
    @endcan
    @can('view_progress_reports')
        <x-nav.link route="admin.construction-e-r-p.progress-reports.index" icon="chart-bar">{{ __('construction-e-r-p/progress-reports.ProgressReports') }}</x-nav.link>
    @endcan

    @can('view_suppliers')
        <x-nav.link route="admin.construction-e-r-p.suppliers.index" icon="truck">{{ __('construction-e-r-p/suppliers.Suppliers') }}</x-nav.link>
    @endcan

    @can('view_employees')
        <x-nav.link route="admin.construction-e-r-p.employees.index" icon="user">{{ __('construction-e-r-p/employees.Employees') }}</x-nav.link>
    @endcan

    @can('view_purchase_orders')
        <x-nav.link route="admin.construction-e-r-p.purchase-orders.index" icon="clipboard-document">{{ __('construction-e-r-p/purchase-orders.PurchaseOrders') }}</x-nav.link>
    @endcan

    @can('view_client_addresses')
        <x-nav.link route="admin.construction-e-r-p.client-addresses.index" icon="map-pin">{{ __('construction-e-r-p/client-addresses.ClientAddresses') }}</x-nav.link>
    @endcan

    @can('view_payments')
        <x-nav.link route="admin.construction-e-r-p.payments.index" icon="banknotes">{{ __('construction-e-r-p/payments.Payments') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 4. School Management --}}
@if(\App\Models\Module::isActive('school-management') && (can('view_school_management_dashboard') || can('view_students')))
<x-nav.group label="{{ __('admin.School Management') }}" icon="academic-cap" route="admin.school-management">
    <x-nav.link route="front.school-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_school_management_dashboard')
        <x-nav.link route="admin.school-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_students')
        <x-nav.link route="admin.school-management.students.index" icon="user">{{ __('school-management/students.Students') }}</x-nav.link>
    @endcan
    @can('view_school_classes')
        <x-nav.link route="admin.school-management.school-classes.index" icon="rectangle-stack">{{ __('school-management/school-classes.SchoolClasses') }}</x-nav.link>
    @endcan
    @can('view_teachers')
        <x-nav.link route="admin.school-management.teachers.index" icon="identification">{{ __('school-management/teachers.Teachers') }}</x-nav.link>
    @endcan
    @can('view_subjects')
        <x-nav.link route="admin.school-management.subjects.index" icon="book-open">{{ __('school-management/subjects.Subjects') }}</x-nav.link>
    @endcan
    @can('view_timetables')
        <x-nav.link route="admin.school-management.timetables.index" icon="clock">{{ __('school-management/timetables.Timetables') }}</x-nav.link>
    @endcan
    @can('view_assignments')
        <x-nav.link route="admin.school-management.assignments.index" icon="document-plus">{{ __('school-management/assignments.Assignments') }}</x-nav.link>
    @endcan
    @can('view_grades')
        <x-nav.link route="admin.school-management.grades.index" icon="chart-bar">{{ __('school-management/grades.Grades') }}</x-nav.link>
    @endcan
    @can('view_attendances')
        <x-nav.link route="admin.school-management.attendances.index" icon="check-badge">{{ __('school-management/attendances.Attendances') }}</x-nav.link>
    @endcan

    @can('view_exams')
        <x-nav.link route="admin.school-management.exams.index" icon="clipboard-document">{{ __('school-management/exams.Exams') }}</x-nav.link>
    @endcan

    @can('view_payments')
        <x-nav.link route="admin.school-management.payments.index" icon="banknotes">{{ __('school-management/payments.Payments') }}</x-nav.link>
    @endcan

    @can('view_guardians')
        <x-nav.link route="admin.school-management.guardians.index" icon="user">{{ __('school-management/guardians.Guardians') }}</x-nav.link>
    @endcan

    @can('view_guardian_addresses')
        <x-nav.link route="admin.school-management.guardian-addresses.index" icon="map-pin">{{ __('school-management/guardian-addresses.GuardianAddresses') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 5. Warehouse Management --}}
@if(\App\Models\Module::isActive('warehouse-management') && (can('view_warehouse_management_dashboard') || can('view_products')))
<x-nav.group label="{{ __('admin.Warehouse Management') }}" icon="archive-box" route="admin.warehouse-management">
    <x-nav.link route="front.warehouse-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_warehouse_management_dashboard')
        <x-nav.link route="admin.warehouse-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_products')
        <x-nav.link route="admin.warehouse-management.products.index" icon="cube">{{ __('warehouse-management/products.Products') }}</x-nav.link>
    @endcan
    @can('view_warehouses')
        <x-nav.link route="admin.warehouse-management.warehouses.index" icon="building-office-2">{{ __('warehouse-management/warehouses.Warehouses') }}</x-nav.link>
    @endcan
    @can('view_categories')
        <x-nav.link route="admin.warehouse-management.categories.index" icon="tag">{{ __('warehouse-management/categories.Categories') }}</x-nav.link>
    @endcan
    @can('view_suppliers')
        <x-nav.link route="admin.warehouse-management.suppliers.index" icon="truck">{{ __('warehouse-management/suppliers.Suppliers') }}</x-nav.link>
    @endcan
    @can('view_stock_transfers')
        <x-nav.link route="admin.warehouse-management.stock-transfers.index" icon="arrows-right-left">{{ __('warehouse-management/stock-transfers.StockTransfers') }}</x-nav.link>
    @endcan
    @can('view_stock_adjustments')
        <x-nav.link route="admin.warehouse-management.stock-adjustments.index" icon="adjustments-vertical">{{ __('warehouse-management/stock-adjustments.StockAdjustments') }}</x-nav.link>
    @endcan

    @can('view_employees')
        <x-nav.link route="admin.warehouse-management.employees.index" icon="users">{{ __('warehouse-management/employees.Employees') }}</x-nav.link>
    @endcan

    @can('view_purchase_orders')
        <x-nav.link route="admin.warehouse-management.purchase-orders.index" icon="clipboard-document">{{ __('warehouse-management/purchase-orders.PurchaseOrders') }}</x-nav.link>
    @endcan

    @can('view_sales')
        <x-nav.link route="admin.warehouse-management.sales.index" icon="banknotes">{{ __('warehouse-management/sales.Sales') }}</x-nav.link>
    @endcan

    @can('view_customers')
        <x-nav.link route="admin.warehouse-management.customers.index" icon="user">{{ __('warehouse-management/customers.Customers') }}</x-nav.link>
    @endcan

    @can('view_customer_addresses')
        <x-nav.link route="admin.warehouse-management.customer-addresses.index" icon="map-pin">{{ __('warehouse-management/customer-addresses.CustomerAddresses') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 6. Clinic Management --}}
@if(\App\Models\Module::isActive('clinic-management') && (can('view_clinic_management_dashboard') || can('view_patients')))
<x-nav.group label="{{ __('admin.Clinic Management') }}" icon="heart" route="admin.clinic-management.dashboard">
    <x-nav.link route="front.clinic-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_clinic_management_dashboard')
        <x-nav.link route="admin.clinic-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_patients')
        <x-nav.link route="admin.clinic-management.patients.index" icon="user-group">{{ __('clinic-management/patients.Patients') }}</x-nav.link>
    @endcan
    @can('view_doctors')
        <x-nav.link route="admin.clinic-management.doctors.index" icon="identification">{{ __('clinic-management/doctors.Doctors') }}</x-nav.link>
    @endcan
    @can('view_visits')
        <x-nav.link route="admin.clinic-management.visits.index" icon="calendar">{{ __('clinic-management/visits.Visits') }}</x-nav.link>
    @endcan
    @can('view_prescriptions')
        <x-nav.link route="admin.clinic-management.prescriptions.index" icon="document-text">{{ __('clinic-management/prescriptions.Prescriptions') }}</x-nav.link>
    @endcan
    @can('view_medical_vitals')
        <x-nav.link route="admin.clinic-management.medical-vitals.index" icon="bolt">{{ __('clinic-management/medical-vitals.MedicalVitals') }}</x-nav.link>
    @endcan
    @can('view_clinic_invoices')
        <x-nav.link route="admin.clinic-management.clinic-invoices.index" icon="calculator">{{ __('clinic-management/clinic-invoices.ClinicInvoices') }}</x-nav.link>
    @endcan

    @can('view_patient_addresses')
        <x-nav.link route="admin.clinic-management.patient-addresses.index" icon="map-pin">{{ __('clinic-management/patient-addresses.PatientAddresses') }}</x-nav.link>
    @endcan

    @can('view_payments')
        <x-nav.link route="admin.clinic-management.payments.index" icon="banknotes">{{ __('clinic-management/payments.Payments') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 7. Restaurant POS --}}
@if(\App\Models\Module::isActive('restaurant-p-o-s') && (can('view_restaurant_p_o_s_dashboard') || can('view_orders')))
<x-nav.group label="{{ __('admin.Restaurant POS') }}" icon="cake" route="admin.restaurant-p-o-s">
    <x-nav.link route="front.restaurant-p-o-s" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_restaurant_p_o_s_dashboard')
        <x-nav.link route="admin.restaurant-p-o-s.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_orders')
        <x-nav.link route="admin.restaurant-p-o-s.orders.index" icon="shopping-bag">{{ __('restaurant-p-o-s/orders.Orders') }}</x-nav.link>
    @endcan
    @can('view_menu_items')
        <x-nav.link route="admin.restaurant-p-o-s.menu-items.index" icon="list-bullet">{{ __('restaurant-p-o-s/menu-items.MenuItems') }}</x-nav.link>
    @endcan
    @can('view_waiters')
        <x-nav.link route="admin.restaurant-p-o-s.waiters.index" icon="user">{{ __('restaurant-p-o-s/waiters.Waiters') }}</x-nav.link>
    @endcan
    @can('view_dining_tables')
        <x-nav.link route="admin.restaurant-p-o-s.dining-tables.index" icon="squares-2x2">{{ __('restaurant-p-o-s/dining-tables.DiningTables') }}</x-nav.link>
    @endcan
    @can('view_ingredients')
        <x-nav.link route="admin.restaurant-p-o-s.ingredients.index" icon="archive-box">{{ __('restaurant-p-o-s/ingredients.Ingredients') }}</x-nav.link>
    @endcan
    @can('view_recipes')
        <x-nav.link route="admin.restaurant-p-o-s.recipes.index" icon="book-open">{{ __('restaurant-p-o-s/recipes.Recipes') }}</x-nav.link>
    @endcan

    @can('view_order_items')
        <x-nav.link route="admin.restaurant-p-o-s.order-items.index" icon="tag">{{ __('restaurant-p-o-s/order-items.OrderItems') }}</x-nav.link>
    @endcan

    @can('view_payments')
        <x-nav.link route="admin.restaurant-p-o-s.payments.index" icon="banknotes">{{ __('restaurant-p-o-s/payments.Payments') }}</x-nav.link>
    @endcan

    @can('view_categories')
        <x-nav.link route="admin.restaurant-p-o-s.categories.index" icon="tag">{{ __('restaurant-p-o-s/categories.Categories') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 8. Real Estate CRM --}}
@if(\App\Models\Module::isActive('real-estate-c-r-m') && (can('view_real_estate_c_r_m_dashboard') || can('view_properties')))
<x-nav.group label="{{ __('admin.Real Estate CRM') }}" icon="home-modern" route="admin.real-estate-c-r-m">
    <x-nav.link route="front.real-estate-c-r-m" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_real_estate_c_r_m_dashboard')
        <x-nav.link route="admin.real-estate-c-r-m.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_properties')
        <x-nav.link route="admin.real-estate-c-r-m.properties.index" icon="home">{{ __('real-estate-c-r-m/properties.Properties') }}</x-nav.link>
    @endcan
    @can('view_agents')
        <x-nav.link route="admin.real-estate-c-r-m.agents.index" icon="user-group">{{ __('real-estate-c-r-m/agents.Agents') }}</x-nav.link>
    @endcan
    @can('view_owners')
        <x-nav.link route="admin.real-estate-c-r-m.owners.index" icon="identification">{{ __('real-estate-c-r-m/owners.Owners') }}</x-nav.link>
    @endcan
    @can('view_contracts')
        <x-nav.link route="admin.real-estate-c-r-m.contracts.index" icon="document-duplicate">{{ __('real-estate-c-r-m/contracts.Contracts') }}</x-nav.link>
    @endcan
    @can('view_property_visits')
        <x-nav.link route="admin.real-estate-c-r-m.property-visits.index" icon="calendar-days">{{ __('real-estate-c-r-m/property-visits.PropertyVisits') }}</x-nav.link>
    @endcan

    @can('view_clients')
        <x-nav.link route="admin.real-estate-c-r-m.clients.index" icon="user">{{ __('real-estate-c-r-m/clients.Clients') }}</x-nav.link>
    @endcan

    @can('view_client_addresses')
        <x-nav.link route="admin.real-estate-c-r-m.client-addresses.index" icon="map-pin">{{ __('real-estate-c-r-m/client-addresses.ClientAddresses') }}</x-nav.link>
    @endcan

    @can('view_payments')
        <x-nav.link route="admin.real-estate-c-r-m.payments.index" icon="banknotes">{{ __('real-estate-c-r-m/payments.Payments') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 9. CRM --}}
@if(\App\Models\Module::isActive('c-r-m') && (can('view_c_r_m_dashboard') || can('view_leads')))
<x-nav.group label="{{ __('admin.CRM') }}" icon="user-group" route="admin.c-r-m">
    <x-nav.link route="front.c-r-m" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_c_r_m_dashboard')
        <x-nav.link route="admin.c-r-m.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_leads')
        <x-nav.link route="admin.c-r-m.leads.index" icon="funnel">{{ __('c-r-m/leads.Leads') }}</x-nav.link>
    @endcan
    @can('view_deals')
        <x-nav.link route="admin.c-r-m.deals.index" icon="currency-dollar">{{ __('c-r-m/deals.Deals') }}</x-nav.link>
    @endcan
    @can('view_companies')
        <x-nav.link route="admin.c-r-m.companies.index" icon="building-office-2">{{ __('c-r-m/companies.Companies') }}</x-nav.link>
    @endcan
    @can('view_contacts')
        <x-nav.link route="admin.c-r-m.contacts.index" icon="user-circle">{{ __('c-r-m/contacts.Contacts') }}</x-nav.link>
    @endcan
    @can('view_tasks')
        <x-nav.link route="admin.c-r-m.tasks.index" icon="check-circle">{{ __('c-r-m/tasks.Tasks') }}</x-nav.link>
    @endcan
    @can('view_interactions')
        <x-nav.link route="admin.c-r-m.interactions.index" icon="chat-bubble-left-right">{{ __('c-r-m/interactions.Interactions') }}</x-nav.link>
    @endcan

    @can('view_contact_addresses')
        <x-nav.link route="admin.c-r-m.contact-addresses.index" icon="map-pin">{{ __('c-r-m/contact-addresses.ContactAddresses') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 10. Finance --}}
@if(\App\Models\Module::isActive('finance') && (can('view_finance_dashboard') || can('view_accounts')))
<x-nav.group label="{{ __('admin.Finance') }}" icon="banknotes" route="admin.finance">
    <x-nav.link route="front.finance" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_finance_dashboard')
        <x-nav.link route="admin.finance.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_accounts')
        <x-nav.link route="admin.finance.accounts.index" icon="building-library">{{ __('finance/accounts.Accounts') }}</x-nav.link>
    @endcan
    @can('view_transactions')
        <x-nav.link route="admin.finance.transactions.index" icon="arrows-right-left">{{ __('finance/transactions.Transactions') }}</x-nav.link>
    @endcan
    @can('view_expenses')
        <x-nav.link route="admin.finance.expenses.index" icon="receipt-percent">{{ __('finance/expenses.Expenses') }}</x-nav.link>
    @endcan
    @can('view_budgets')
        <x-nav.link route="admin.finance.budgets.index" icon="chart-pie">{{ __('finance/budgets.Budgets') }}</x-nav.link>
    @endcan
    @can('view_documents')
        <x-nav.link route="admin.finance.documents.index" icon="document-duplicate">{{ __('finance/documents.Documents') }}</x-nav.link>
    @endcan

    @can('view_categories')
        <x-nav.link route="admin.finance.categories.index" icon="tag">{{ __('finance/categories.Categories') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 11. Agriculture Management --}}
@if(\App\Models\Module::isActive('agriculture-management') && (can('view_agriculture_management_dashboard') || can('view_fields')))
<x-nav.group label="{{ __('admin.Agriculture Management') }}" icon="sun" route="admin.agriculture-management">
    <x-nav.link route="front.agriculture-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_agriculture_management_dashboard')
        <x-nav.link route="admin.agriculture-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_fields')
        <x-nav.link route="admin.agriculture-management.fields.index" icon="map">{{ __('agriculture-management/fields.Fields') }}</x-nav.link>
    @endcan
    @can('view_crops')
        <x-nav.link route="admin.agriculture-management.crops.index" icon="tag">{{ __('agriculture-management/crops.Crops') }}</x-nav.link>
    @endcan
    @can('view_inventory_supplies')
        <x-nav.link route="admin.agriculture-management.inventory-supplies.index" icon="archive-box">{{ __('agriculture-management/inventory-supplies.InventorySupplies') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 12. Fleet Management --}}
@if(\App\Models\Module::isActive('fleet-management') && (can('view_fleet_management_dashboard') || can('view_vehicles')))
<x-nav.group label="{{ __('admin.Fleet Management') }}" icon="truck" route="admin.fleet-management">
    <x-nav.link route="front.fleet-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_fleet_management_dashboard')
        <x-nav.link route="admin.fleet-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_vehicles')
        <x-nav.link route="admin.fleet-management.vehicles.index" icon="truck">{{ __('fleet-management/vehicles.Vehicles') }}</x-nav.link>
    @endcan
    @can('view_drivers')
        <x-nav.link route="admin.fleet-management.drivers.index" icon="identification">{{ __('fleet-management/drivers.Drivers') }}</x-nav.link>
    @endcan
    @can('view_shipments')
        <x-nav.link route="admin.fleet-management.shipments.index" icon="archive-box">{{ __('fleet-management/shipments.Shipments') }}</x-nav.link>
    @endcan
    @can('view_trips')
        <x-nav.link route="admin.fleet-management.trips.index" icon="map-pin">{{ __('fleet-management/trips.Trips') }}</x-nav.link>
    @endcan
    @can('view_fuel_logs')
        <x-nav.link route="admin.fleet-management.fuel-logs.index" icon="fire">{{ __('fleet-management/fuel-logs.FuelLogs') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 13. Gym Management --}}
@if(\App\Models\Module::isActive('gym-management') && (can('view_gym_management_dashboard') || can('view_members')))
<x-nav.group label="{{ __('admin.Gym Management') }}" icon="bolt" route="admin.gym-management">
    <x-nav.link route="front.gym-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_gym_management_dashboard')
        <x-nav.link route="admin.gym-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_members')
        <x-nav.link route="admin.gym-management.members.index" icon="user-group">{{ __('gym-management/members.Members') }}</x-nav.link>
    @endcan
    @can('view_membership_plans')
        <x-nav.link route="admin.gym-management.membership-plans.index" icon="ticket">{{ __('gym-management/membership-plans.MembershipPlans') }}</x-nav.link>
    @endcan
    @can('view_subscriptions')
        <x-nav.link route="admin.gym-management.subscriptions.index" icon="calendar-days">{{ __('gym-management/subscriptions.Subscriptions') }}</x-nav.link>
    @endcan
    @can('view_trainers')
        <x-nav.link route="admin.gym-management.trainers.index" icon="identification">{{ __('gym-management/trainers.Trainers') }}</x-nav.link>
    @endcan

    @can('view_class_schedules')
        <x-nav.link route="admin.gym-management.class-schedules.index" icon="clock">{{ __('gym-management/class-schedules.ClassSchedules') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 14. Hotel Management --}}
@if(\App\Models\Module::isActive('hotel-management') && (can('view_hotel_management_dashboard') || can('view_reservations')))
<x-nav.group label="{{ __('admin.Hotel Management') }}" icon="home-modern" route="admin.hotel-management">
    <x-nav.link route="front.hotel-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_hotel_management_dashboard')
        <x-nav.link route="admin.hotel-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_reservations')
        <x-nav.link route="admin.hotel-management.reservations.index" icon="calendar">{{ __('hotel-management/reservations.Reservations') }}</x-nav.link>
    @endcan
    @can('view_hotel_rooms')
        <x-nav.link route="admin.hotel-management.hotel-rooms.index" icon="key">{{ __('hotel-management/hotel-rooms.HotelRooms') }}</x-nav.link>
    @endcan
    @can('view_room_types')
        <x-nav.link route="admin.hotel-management.room-types.index" icon="tag">{{ __('hotel-management/room-types.RoomTypes') }}</x-nav.link>
    @endcan
    @can('view_guests')
        <x-nav.link route="admin.hotel-management.guests.index" icon="user-group">{{ __('hotel-management/guests.Guests') }}</x-nav.link>
    @endcan

    @can('view_housekeepings')
        <x-nav.link route="admin.hotel-management.housekeepings.index" icon="clipboard-document">{{ __('hotel-management/housekeepings.Housekeepings') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 15. Human Resources --}}
@if(\App\Models\Module::isActive('human-resources') && (can('view_human_resources_dashboard') || can('view_employees')))
<x-nav.group label="{{ __('admin.Human Resources') }}" icon="users" route="admin.human-resources">
    <x-nav.link route="front.human-resources" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_human_resources_dashboard')
        <x-nav.link route="admin.human-resources.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_employees')
        <x-nav.link route="admin.human-resources.employees.index" icon="user">{{ __('human-resources/employees.Employees') }}</x-nav.link>
    @endcan
    @can('view_departments')
        <x-nav.link route="admin.human-resources.departments.index" icon="building-office">{{ __('human-resources/departments.Departments') }}</x-nav.link>
    @endcan
    @can('view_attendances')
        <x-nav.link route="admin.human-resources.attendances.index" icon="clock">{{ __('human-resources/attendances.Attendances') }}</x-nav.link>
    @endcan
    @can('view_leave_requests')
        <x-nav.link route="admin.human-resources.leave-requests.index" icon="calendar-days">{{ __('human-resources/leave-requests.LeaveRequests') }}</x-nav.link>
    @endcan
    @can('view_payrolls')
        <x-nav.link route="admin.human-resources.payrolls.index" icon="banknotes">{{ __('human-resources/payrolls.Payrolls') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 16. E-Commerce --}}
@if(\App\Models\Module::isActive('e--commerce') && (can('view_e--commerce_dashboard') || can('view_products')))
<x-nav.group label="{{ __('admin.E-Commerce') }}" icon="shopping-cart" route="admin.e--commerce">
    <x-nav.link route="front.e--commerce" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_e--commerce_dashboard')
        <x-nav.link route="admin.e--commerce.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_products')
        <x-nav.link route="admin.e--commerce.products.index" icon="cube">{{ __('e--commerce/products.Products') }}</x-nav.link>
    @endcan
    @can('view_vendors')
        <x-nav.link route="admin.e--commerce.vendors.index" icon="building-storefront">{{ __('e--commerce/vendors.Vendors') }}</x-nav.link>
    @endcan
    @can('view_orders')
        <x-nav.link route="admin.e--commerce.orders.index" icon="shopping-bag">{{ __('e--commerce/orders.Orders') }}</x-nav.link>
    @endcan

    @can('view_order_items')
        <x-nav.link route="admin.e--commerce.order-items.index" icon="tag">{{ __('e--commerce/order-items.OrderItems') }}</x-nav.link>
    @endcan

    @can('view_customers')
        <x-nav.link route="admin.e--commerce.customers.index" icon="user">{{ __('e--commerce/customers.Customers') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 17. Facility Management --}}
@if(\App\Models\Module::isActive('facility-management') && (can('view_facility_management_dashboard') || can('view_technicians')))
<x-nav.group label="{{ __('admin.Facility Management') }}" icon="wrench-screwdriver" route="admin.facility-management">
    <x-nav.link route="front.facility-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_facility_management_dashboard')
        <x-nav.link route="admin.facility-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_technicians')
        <x-nav.link route="admin.facility-management.technicians.index" icon="user-group">{{ __('facility-management/technicians.Technicians') }}</x-nav.link>
    @endcan
    @can('view_buildings')
        <x-nav.link route="admin.facility-management.buildings.index" icon="building-office">{{ __('facility-management/buildings.Buildings') }}</x-nav.link>
    @endcan
    @can('view_maintenance_requests')
        <x-nav.link route="admin.facility-management.maintenance-requests.index" icon="clipboard-document">{{ __('facility-management/maintenance-requests.MaintenanceRequests') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 18. Travel Agency --}}
@if(\App\Models\Module::isActive('travel-agency') && (can('view_travel_agency_dashboard') || can('view_tour_packages')))
<x-nav.group label="{{ __('admin.Travel Agency') }}" icon="globe-alt" route="admin.travel-agency">
    <x-nav.link route="front.travel-agency" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_travel_agency_dashboard')
        <x-nav.link route="admin.travel-agency.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_tour_packages')
        <x-nav.link route="admin.travel-agency.tour-packages.index" icon="briefcase">{{ __('travel-agency/tour-packages.TourPackages') }}</x-nav.link>
    @endcan
    @can('view_destinations')
        <x-nav.link route="admin.travel-agency.destinations.index" icon="map-pin">{{ __('travel-agency/destinations.Destinations') }}</x-nav.link>
    @endcan
    @can('view_clients')
        <x-nav.link route="admin.travel-agency.clients.index" icon="user">{{ __('travel-agency/clients.Clients') }}</x-nav.link>
    @endcan
    @can('view_tour_bookings')
        <x-nav.link route="admin.travel-agency.tour-bookings.index" icon="calendar">{{ __('travel-agency/tour-bookings.TourBookings') }}</x-nav.link>
    @endcan
    @can('view_flight_tickets')
        <x-nav.link route="admin.travel-agency.flight-tickets.index" icon="paper-airplane">{{ __('travel-agency/flight-tickets.FlightTickets') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 19. Event Management --}}
@if(\App\Models\Module::isActive('event-management') && (can('view_event_management_dashboard') || can('view_events')))
<x-nav.group label="{{ __('admin.Event Management') }}" icon="sparkles" route="admin.event-management">
    <x-nav.link route="front.event-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_event_management_dashboard')
        <x-nav.link route="admin.event-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_events')
        <x-nav.link route="admin.event-management.events.index" icon="calendar">{{ __('event-management/events.Events') }}</x-nav.link>
    @endcan
    @can('view_organizers')
        <x-nav.link route="admin.event-management.organizers.index" icon="identification">{{ __('event-management/organizers.Organizers') }}</x-nav.link>
    @endcan
    @can('view_ticket_types')
        <x-nav.link route="admin.event-management.ticket-types.index" icon="tag">{{ __('event-management/ticket-types.TicketTypes') }}</x-nav.link>
    @endcan
    @can('view_attendees')
        <x-nav.link route="admin.event-management.attendees.index" icon="user-group">{{ __('event-management/attendees.Attendees') }}</x-nav.link>
    @endcan
    @can('view_bookings')
        <x-nav.link route="admin.event-management.bookings.index" icon="clipboard-document">{{ __('event-management/bookings.Bookings') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- 20. Pharmacy Management --}}
@if(\App\Models\Module::isActive('pharmacy-management') && (can('view_pharmacy_management_dashboard') || can('view_medicines')))
<x-nav.group label="{{ __('admin.Pharmacy Management') }}" icon="beaker" route="admin.pharmacy-management">
    <x-nav.link route="front.pharmacy-management" icon="globe-alt" target="_blank">{{ __('admin.Landing Page') }}</x-nav.link>
    @can('view_pharmacy_management_dashboard')
        <x-nav.link route="admin.pharmacy-management.dashboard" icon="presentation-chart-bar">{{ __('admin.Dashboard') }}</x-nav.link>
    @endcan
    @can('view_medicines')
        <x-nav.link route="admin.pharmacy-management.medicines.index" icon="archive-box">{{ __('pharmacy-management/medicines.Medicines') }}</x-nav.link>
    @endcan
    @can('view_suppliers')
        <x-nav.link route="admin.pharmacy-management.suppliers.index" icon="truck">{{ __('pharmacy-management/suppliers.Suppliers') }}</x-nav.link>
    @endcan
    @can('view_prescriptions')
        <x-nav.link route="admin.pharmacy-management.prescriptions.index" icon="document-text">{{ __('pharmacy-management/prescriptions.Prescriptions') }}</x-nav.link>
    @endcan
    @can('view_sales')
        <x-nav.link route="admin.pharmacy-management.sales.index" icon="banknotes">{{ __('pharmacy-management/sales.Sales') }}</x-nav.link>
    @endcan

    @can('view_prescription_items')
        <x-nav.link route="admin.pharmacy-management.prescription-items.index" icon="tag">{{ __('pharmacy-management/prescription-items.PrescriptionItems') }}</x-nav.link>
    @endcan
</x-nav.group>
@endif

{{-- MODULAR GROUPS END --}}

@if(can('view_system_settings') || can('view_roles') || can('view_audit_trails'))
    <x-nav.divider>{{ __('admin.Settings') }}</x-nav.divider>
@endif

@can('view_audit_trails')
    <x-nav.link route="admin.settings.audit-trails.index" icon="identification">{{ __('admin.Audit Trails') }}</x-nav.link>
@endcan

@can('view_roles')
    <x-nav.link route="admin.settings.roles.index" icon="key">{{ __('admin.Roles') }}</x-nav.link>
@endcan

@can('view_system_settings')
    <x-nav.link route="admin.settings.module-management" icon="rectangle-group">{{ __('admin.Module Management') }}</x-nav.link>
    <x-nav.link route="admin.settings" icon="cog-6-tooth">{{ __('admin.System Settings') }}</x-nav.link>
    <x-nav.link route="admin.settings.ai-assistant" icon="cpu-chip">{{ __('AI Assistant') }}</x-nav.link>
    <x-nav.link route="admin.settings.languages.index" icon="globe-alt">{{ __('admin.Languages') }}</x-nav.link>
    <x-nav.link route="admin.settings.notifications" icon="bell">{{ __('admin.Notifications') }}</x-nav.link>
@endcan

<x-nav.link route="admin.settings.notification-preferences" icon="adjustments-horizontal">{{ __('My Notifications') }}</x-nav.link>

<x-nav.divider>{{ __('admin.Account') }}</x-nav.divider>

@can('view_users')
    <x-nav.link route="admin.users.index" icon="users">{{ __('admin.Users') }}</x-nav.link>
@endcan
