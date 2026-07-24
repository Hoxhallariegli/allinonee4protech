<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Domain\Category\DTOs\CategoryDTO;
use App\Domain\Category\Actions\CreateCategoryAction;
use Illuminate\Support\Str;
use Livewire\{Component, Attributes\Title};

#[Title('Add Category')]
class Create extends Component
{
    public $name = '';
    public $slug = '';
    public $no = '';

    public function render() { abort_if_cannot('add_categories'); return view('livewire.admin.categories.create', [
        ])->layout('components.layouts.app'); }

    public function store(CreateCategoryAction $action)
    {
        $this->validate();

        $dto = CategoryDTO::fromArray([
            'name' => $this->name,
            'slug' => $this->slug,
            'no' => $this->no,
        ]);
        $action->execute($dto);
        flash(__('Category created'))->success();
        return to_route('admin.categories.index');
    }
    protected function rules(): array { return Category::rules(); }
}