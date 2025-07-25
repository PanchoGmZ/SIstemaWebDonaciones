<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Categoría creada exitosamente');
    }

    public function show($id)
    {
        $category = Category::with('campaigns')->findOrFail($id);

        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
        ]);

        $category->update($validated);

        return redirect()->route('categories.show', $category->id)
                         ->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->campaigns()->count() > 0) {
            return redirect()->route('categories.index')
                             ->withErrors('No se puede eliminar una categoría con campañas asociadas.');
        }

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Categoría eliminada exitosamente');
    }
}
