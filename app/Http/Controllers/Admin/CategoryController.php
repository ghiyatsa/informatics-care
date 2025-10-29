<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    /**
     * Display a listing of categories
     */
    public function index(): View
    {
        $categories = $this->categoryService->getAllCategories();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->createCategory($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified category
     */
    public function show(Category $category): View
    {
        $data = $this->categoryService->getCategoryWithReports($category);

        return view('admin.categories.show', [
            'category' => $data['category'],
            'reports' => $data['reports'],
        ]);
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->categoryService->updateCategory($category, $request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            $this->categoryService->deleteCategory($category);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
