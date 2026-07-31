<?php

namespace App\Livewire\Admin\SchoolManagement\Payments;

use App\Models\SchoolManagement\Payment;
use App\Domain\SchoolManagement\Payment\DTOs\PaymentDTO;
use App\Domain\SchoolManagement\Payment\Actions\UpdatePaymentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Payment')]
class Edit extends Component
{
        use WithPagination;
 public Payment $item;
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

    public function mount(Payment $payment) { $this->item = $payment; $this->fill($payment->toArray()); $this->payment_date = $payment->payment_date?->format('Y-m-d'); }
    public function render() { abort_if_cannot('edit_payments'); return view('livewire.admin.school-management.payments.edit', [
            'students' => $this->getstudentsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdatePaymentAction $action) { $this->validate();  $dto = PaymentDTO::fromArray([
            'student_id' => $this->student_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/payments.updated')); return to_route('admin.school-management.payments.index'); }
    protected function rules(): array { return Payment::rules($this->item->id); }
}