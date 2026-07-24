<?php

namespace App\Domain\Category\Actions;

use App\Models\Category;

class DeleteCategoryAction
{
    public function execute(Category $model): bool { return $model->delete(); }
}