<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService
{
    /**
     * Get all categories with reports count
     */
    public function getAllCategories(int $perPage = 20): LengthAwarePaginator
    {
        return Category::withCount('reports')
            ->orderBy('name')
            ->paginate($perPage);
    }

    /**
     * Create a new category
     */
    public function createCategory(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update category
     */
    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);
        return $category->fresh();
    }

    /**
     * Delete category if it has no reports
     */
    public function deleteCategory(Category $category): bool
    {
        if ($category->reports()->count() > 0) {
            throw new \Exception('Kategori tidak dapat dihapus karena memiliki laporan!');
        }

        return $category->delete();
    }

    /**
     * Get category with reports
     *
     * @return array{category: Category, reports: \Illuminate\Contracts\Pagination\LengthAwarePaginator}
     */
    public function getCategoryWithReports(Category $category, int $perPage = 10): array
    {
        $category->loadCount('reports');
        $reports = $category->reports()
            ->with('user')
            ->latest()
            ->paginate($perPage);

        return [
            'category' => $category,
            'reports' => $reports,
        ];
    }
}

