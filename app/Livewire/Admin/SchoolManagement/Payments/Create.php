<?php

namespace App\Livewire\Admin\SchoolManagement\Payments;

use App\Models\SchoolManagement\Payment;
use App\Domain\SchoolManagement\Payment\DTOs\PaymentDTO;
use App\Domain\SchoolManagement\Payment\Actions\CreatePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Payment')]
class Create extends Component
{
        use WithPagination;
     public $student_id = '';
    public $amount = '';
    public $payment_date = '';
 
    #[On('student-created')] 
    public function refreshStudents($id) { $this->student_id = $id; $this->updatedStudentId($id); }
 
    public function updatedStudentId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Student::find($value);
        if (!$related) return;
    }
 
    protected function getstudentsList() {
        return \App\Models\SchoolManagement\Student::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_payments');
        return view('livewire.admin.school-management.payments.create', [
            'students' => $this->getstudentsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreatePaymentAction $action) { $this->validate();  $dto = PaymentDTO::fromArray([
            'student_id' => $this->student_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
        ]); $action->execute($dto); session()->flash('success', __('school-management/payments.created')); return to_route('admin.school-management.payments.index'); }
    protected function rules(): array { return Payment::rules(); }
}