<?php

namespace App\Livewire\Admin\Finance\Categories;

use App\Models\Finance\Category;
use App\Domain\Finance\Category\DTOs\CategoryDTO;
use App\Domain\Finance\Category\Actions\CreateCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Category')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $type = '';
   
    public function render() {
        abort_if_cannot('add_categories');
        return view('livewire.admin.finance.categories.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateCategoryAction $action) { $this->validate();  $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'type' => $this->type,
        ]); $action->execute($dto); session()->flash('success', __('finance/categories.created')); return to_route('admin.finance.categories.index'); }
    protected function rules(): array { return Category::rules(); }
}