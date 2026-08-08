<?php

namespace App\Livewire\Admin\RestaurantPOS\Categories;

use App\Models\RestaurantPOS\Category;
use App\Domain\RestaurantPOS\Category\DTOs\CategoryDTO;
use App\Domain\RestaurantPOS\Category\Actions\UpdateCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Category')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Category $item;
    public $name = '';
    public $photo = '';
   
    public function mount(Category $category) { $this->item = $category; $this->fill($category->toArray());  }
    public function render() {
        abort_if_cannot('edit_categories');
        return view('livewire.admin.restaurant-p-o-s.categories.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateCategoryAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/categories', 'uploads'); }
 $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('restaurant-p-o-s/categories.updated')); return to_route('admin.restaurant-p-o-s.categories.index'); }
    protected function rules(): array { return Category::rules($this->item->id); }
}