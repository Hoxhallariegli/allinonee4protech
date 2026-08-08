<?php

namespace App\Livewire\Admin\Finance\Categories;

use App\Models\Finance\Category;
use App\Domain\Finance\Category\DTOs\CategoryDTO;
use App\Domain\Finance\Category\Actions\UpdateCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Category')]
class Edit extends Component
{
        use WithPagination;
 public Category $item;
    public $name = '';
    public $type = '';
   
    public function mount(Category $category) { $this->item = $category; $this->fill($category->toArray());  }
    public function render() {
        abort_if_cannot('edit_categories');
        return view('livewire.admin.finance.categories.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateCategoryAction $action) { $this->validate();  $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'type' => $this->type,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('finance/categories.updated')); return to_route('admin.finance.categories.index'); }
    protected function rules(): array { return Category::rules($this->item->id); }
}