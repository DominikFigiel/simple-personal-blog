<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\DestroyCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $fillable = [
        'name'
    ];

    public function index(): View
    {
        $categories = Category::all();

        return view('category.list', [
            'categories' => $categories
        ]);
    }

    public function create(): View
    {
        return view('category.add');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $categoryName = $data['name'];

        $category = new Category;

        $category->name = $categoryName;
        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategoria została dodana do bazy danych.');
    }

    public function destroy(DestroyCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $id = (int) $data['id'];

        $category = Category::find($id);

        if($category)
        {
            $category->delete();

            return redirect()
            ->route('categories.index')
            ->with('success', 'Kategoria została usunięta');
        }
        else
        {
            return redirect()
            ->route('categories.index')
            ->with('error', 'Wystąpił błąd. Kategoria nie została usunięta');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }
}
