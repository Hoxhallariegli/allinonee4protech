<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Domain\Category\DTOs\CategoryDTO;
use App\Domain\Category\Actions\UpdateCategoryAction;
use Illuminate\Support\Str;
use Livewire\{Component, Attributes\Title};

#[Title('Edit Category')]
class Edit extends Component
{
    public Category $item;
    public $name = '';
    public $slug = '';
    public $no = '';

    public function mount(Category $item) { $this->item = $item; $this->fill($item->toArray());  }
    public function render() { abort_if_cannot('edit_categories'); return view('livewire.admin.categories.edit', [
        ])->layout('components.layouts.app'); }

    public function update(UpdateCategoryAction $action)
    {
        $this->validate();

        $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'slug' => $this->slug,
            'no' => $this->no,
        ]);
        $action->execute($this->item, $dto);
        flash(__('Category updated'))->success();
        return to_route('admin.categories.index');
    }
    protected function rules(): array { return Category::rules($this->item->id); }
}