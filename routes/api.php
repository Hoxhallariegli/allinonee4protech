<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/











































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































Route::apiResource('reminders', \App\Http\Controllers\Api\ReminderController::class);
Route::apiResource('customers', \App\Http\Controllers\Api\CustomerController::class);
Route::apiResource('barbers', \App\Http\Controllers\Api\BarberController::class);
Route::apiResource('services', \App\Http\Controllers\Api\ServiceController::class);
Route::apiResource('bookings', \App\Http\Controllers\Api\BookingController::class);
Route::apiResource('vehicle-brands', \App\Http\Controllers\Api\VehicleBrandController::class);
Route::apiResource('vehicle-models', \App\Http\Controllers\Api\VehicleModelController::class);
Route::apiResource('vehicles', \App\Http\Controllers\Api\VehicleController::class);
Route::apiResource('mechanics', \App\Http\Controllers\Api\MechanicController::class);
Route::apiResource('job-cards', \App\Http\Controllers\Api\JobCardController::class);
Route::apiResource('invoices', \App\Http\Controllers\Api\InvoiceController::class);
Route::apiResource('clients', \App\Http\Controllers\Api\ClientController::class);
Route::apiResource('projects', \App\Http\Controllers\Api\ProjectController::class);
Route::apiResource('buildings', \App\Http\Controllers\Api\BuildingController::class);
Route::apiResource('apartments', \App\Http\Controllers\Api\ApartmentController::class);
Route::apiResource('employees', \App\Http\Controllers\Api\EmployeeController::class);
Route::apiResource('contracts', \App\Http\Controllers\Api\ContractController::class);
Route::apiResource('payments', \App\Http\Controllers\Api\PaymentController::class);
Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('suppliers', \App\Http\Controllers\Api\SupplierController::class);
Route::apiResource('warehouses', \App\Http\Controllers\Api\WarehouseController::class);
Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class);
Route::apiResource('sales', \App\Http\Controllers\Api\SaleController::class);
Route::apiResource('stock-transfers', \App\Http\Controllers\Api\StockTransferController::class);
Route::apiResource('patients', \App\Http\Controllers\Api\PatientController::class);
Route::apiResource('doctors', \App\Http\Controllers\Api\DoctorController::class);
Route::apiResource('visits', \App\Http\Controllers\Api\VisitController::class);
Route::apiResource('prescriptions', \App\Http\Controllers\Api\PrescriptionController::class);
Route::apiResource('waiters', \App\Http\Controllers\Api\WaiterController::class);
Route::apiResource('dining-tables', \App\Http\Controllers\Api\DiningTableController::class);
Route::apiResource('menu-items', \App\Http\Controllers\Api\MenuItemController::class);
Route::apiResource('orders', \App\Http\Controllers\Api\OrderController::class);
Route::apiResource('device-tokens', \App\Http\Controllers\Api\DeviceTokenController::class);
Route::apiResource('customer-addresses', \App\Http\Controllers\Api\CustomerAddressController::class);
Route::apiResource('client-addresses', \App\Http\Controllers\Api\ClientAddressController::class);
Route::apiResource('teachers', \App\Http\Controllers\Api\TeacherController::class);
Route::apiResource('guardian-addresses', \App\Http\Controllers\Api\GuardianAddressController::class);
Route::apiResource('patient-addresses', \App\Http\Controllers\Api\PatientAddressController::class);
Route::apiResource('agents', \App\Http\Controllers\Api\AgentController::class);
Route::apiResource('contact-addresses', \App\Http\Controllers\Api\ContactAddressController::class);
Route::apiResource('guardians', \App\Http\Controllers\Api\GuardianController::class);
Route::apiResource('school-classes', \App\Http\Controllers\Api\SchoolClassController::class);
Route::apiResource('students', \App\Http\Controllers\Api\StudentController::class);
Route::apiResource('attendances', \App\Http\Controllers\Api\AttendanceController::class);
Route::apiResource('progress-reports', \App\Http\Controllers\Api\ProgressReportController::class);
Route::apiResource('clinic-invoices', \App\Http\Controllers\Api\ClinicInvoiceController::class);
Route::apiResource('owners', \App\Http\Controllers\Api\OwnerController::class);
Route::apiResource('properties', \App\Http\Controllers\Api\PropertyController::class);
Route::apiResource('property-visits', \App\Http\Controllers\Api\PropertyVisitController::class);
Route::apiResource('companies', \App\Http\Controllers\Api\CompanyController::class);
Route::apiResource('contacts', \App\Http\Controllers\Api\ContactController::class);
Route::apiResource('leads', \App\Http\Controllers\Api\LeadController::class);
Route::apiResource('deals', \App\Http\Controllers\Api\DealController::class);
Route::apiResource('tasks', \App\Http\Controllers\Api\TaskController::class);
Route::apiResource('order-items', \App\Http\Controllers\Api\OrderItemController::class);
Route::apiResource('expense-trackings', \App\Http\Controllers\Api\ExpenseTrackingController::class);
Route::apiResource('insurance-claims', \App\Http\Controllers\Api\InsuranceClaimController::class);
Route::apiResource('subcontractors', \App\Http\Controllers\Api\SubcontractorController::class);
Route::apiResource('equipment', \App\Http\Controllers\Api\EquipmentController::class);
Route::apiResource('heavy-machineries', \App\Http\Controllers\Api\HeavyMachineryController::class);
Route::apiResource('subjects', \App\Http\Controllers\Api\SubjectController::class);
Route::apiResource('timetables', \App\Http\Controllers\Api\TimetableController::class);
Route::apiResource('assignments', \App\Http\Controllers\Api\AssignmentController::class);
Route::apiResource('interactions', \App\Http\Controllers\Api\InteractionController::class);
Route::apiResource('stock-adjustments', \App\Http\Controllers\Api\StockAdjustmentController::class);
Route::apiResource('medical-vitals', \App\Http\Controllers\Api\MedicalVitalController::class);
Route::apiResource('ingredients', \App\Http\Controllers\Api\IngredientController::class);
Route::apiResource('recipes', \App\Http\Controllers\Api\RecipeController::class);
Route::apiResource('grades', \App\Http\Controllers\Api\GradeController::class);
Route::apiResource('materials', \App\Http\Controllers\Api\MaterialController::class);
Route::apiResource('purchase-orders', \App\Http\Controllers\Api\PurchaseOrderController::class);
Route::apiResource('parts', \App\Http\Controllers\Api\PartController::class);
Route::apiResource('inventories', \App\Http\Controllers\Api\InventoryController::class);
Route::apiResource('job-card-services', \App\Http\Controllers\Api\JobCardServiceController::class);
Route::apiResource('job-card-parts', \App\Http\Controllers\Api\JobCardPartController::class);
Route::apiResource('vehicle-documents', \App\Http\Controllers\Api\VehicleDocumentController::class);
Route::apiResource('appointments', \App\Http\Controllers\Api\AppointmentController::class);
Route::apiResource('room-types', \App\Http\Controllers\Api\RoomTypeController::class);
Route::apiResource('hotel-rooms', \App\Http\Controllers\Api\HotelRoomController::class);
Route::apiResource('guests', \App\Http\Controllers\Api\GuestController::class);
Route::apiResource('reservations', \App\Http\Controllers\Api\ReservationController::class);
Route::apiResource('housekeepings', \App\Http\Controllers\Api\HousekeepingController::class);
Route::apiResource('departments', \App\Http\Controllers\Api\DepartmentController::class);
Route::apiResource('leave-requests', \App\Http\Controllers\Api\LeaveRequestController::class);
Route::apiResource('payrolls', \App\Http\Controllers\Api\PayrollController::class);
Route::apiResource('vendors', \App\Http\Controllers\Api\VendorController::class);
Route::apiResource('drivers', \App\Http\Controllers\Api\DriverController::class);
Route::apiResource('shipments', \App\Http\Controllers\Api\ShipmentController::class);
Route::apiResource('trips', \App\Http\Controllers\Api\TripController::class);
Route::apiResource('fuel-logs', \App\Http\Controllers\Api\FuelLogController::class);
Route::apiResource('membership-plans', \App\Http\Controllers\Api\MembershipPlanController::class);
Route::apiResource('members', \App\Http\Controllers\Api\MemberController::class);
Route::apiResource('subscriptions', \App\Http\Controllers\Api\SubscriptionController::class);
Route::apiResource('trainers', \App\Http\Controllers\Api\TrainerController::class);
Route::apiResource('class-schedules', \App\Http\Controllers\Api\ClassScheduleController::class);
Route::apiResource('transactions', \App\Http\Controllers\Api\TransactionController::class);
Route::apiResource('documents', \App\Http\Controllers\Api\DocumentController::class);
Route::apiResource('cases', \App\Http\Controllers\Api\CaseController::class);
Route::apiResource('legal-cases', \App\Http\Controllers\Api\LegalCaseController::class);
Route::apiResource('hearings', \App\Http\Controllers\Api\HearingController::class);
Route::apiResource('billings', \App\Http\Controllers\Api\BillingController::class);
Route::apiResource('medicines', \App\Http\Controllers\Api\MedicineController::class);
Route::apiResource('prescription-items', \App\Http\Controllers\Api\PrescriptionItemController::class);
Route::apiResource('organizers', \App\Http\Controllers\Api\OrganizerController::class);
Route::apiResource('events', \App\Http\Controllers\Api\EventController::class);
Route::apiResource('ticket-types', \App\Http\Controllers\Api\TicketTypeController::class);
Route::apiResource('attendees', \App\Http\Controllers\Api\AttendeeController::class);
Route::apiResource('destinations', \App\Http\Controllers\Api\DestinationController::class);
Route::apiResource('tour-packages', \App\Http\Controllers\Api\TourPackageController::class);
Route::apiResource('tour-bookings', \App\Http\Controllers\Api\TourBookingController::class);
Route::apiResource('flight-tickets', \App\Http\Controllers\Api\FlightTicketController::class);
Route::apiResource('technicians', \App\Http\Controllers\Api\TechnicianController::class);
Route::apiResource('maintenance-requests', \App\Http\Controllers\Api\MaintenanceRequestController::class);
Route::apiResource('fields', \App\Http\Controllers\Api\FieldController::class);
Route::apiResource('crops', \App\Http\Controllers\Api\CropController::class);
Route::apiResource('inventory-supplies', \App\Http\Controllers\Api\InventorySupplyController::class);
Route::apiResource('accounts', \App\Http\Controllers\Api\AccountController::class);
Route::apiResource('expenses', \App\Http\Controllers\Api\ExpenseController::class);
Route::apiResource('budgets', \App\Http\Controllers\Api\BudgetController::class);
Route::apiResource('purchase-order-items', \App\Http\Controllers\Api\PurchaseOrderItemController::class);
Route::apiResource('estimates', \App\Http\Controllers\Api\EstimateController::class);
Route::apiResource('estimate-items', \App\Http\Controllers\Api\EstimateItemController::class);
Route::apiResource('invoice-items', \App\Http\Controllers\Api\InvoiceItemController::class);
Route::apiResource('reports', \App\Http\Controllers\Api\ReportController::class);
Route::apiResource('exams', \App\Http\Controllers\Api\ExamController::class);