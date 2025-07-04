<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $filename);
            $data['image'] = $filename;
        }

        Category::create($data);
        Alert::success(__('settings.success'), __('categories.created'));
        return redirect()->route('ad.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                unlink(public_path('uploads/categories/' . $category->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $filename);
            $data['image'] = $filename;
        }


        $category->update($data);

        Alert::success(__('settings.success'), __('categories.updated'));
        return redirect()->route('ad.categories.index');
    }


    public function destroy(Category $category)
    {
        // Storage::disk('public')->delete($category->image);
        $category->clearMediaCollection('image');
        $category->delete();

        return redirect()->back();
    }
}
