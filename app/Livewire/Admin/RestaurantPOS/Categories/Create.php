<?php

namespace App\Livewire\Admin\RestaurantPOS\Categories;

use App\Models\RestaurantPOS\Category;
use App\Domain\RestaurantPOS\Category\DTOs\CategoryDTO;
use App\Domain\RestaurantPOS\Category\Actions\CreateCategoryAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Category')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_categories');
        return view('livewire.admin.restaurant-p-o-s.categories.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateCategoryAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/categories', 'uploads'); }
 $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('restaurant-p-o-s/categories.created')); return to_route('admin.restaurant-p-o-s.categories.index'); }
    protected function rules(): array { return Category::rules(); }
}