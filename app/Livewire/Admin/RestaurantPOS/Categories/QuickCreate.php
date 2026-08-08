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

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.restaurant-p-o-s.categories.quick-create', [
        ]); }

    public function store(CreateCategoryAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/categories', 'uploads'); }
        $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('category-created', id: $item->id);
        $this->js("Livewire.dispatch('category-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('restaurant-p-o-s/categories.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Category::rules(); }
}