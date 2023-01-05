<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{
    //
    public function category()
    {
        $categoryList = Category::get();
        return view('Admin.category.list', compact('categoryList'));
    }

    public function categoryCreate()
    {
        $title = 'Create Category';
        $key = 'add';
        return view('Admin.category.add', compact('title', 'key'));
    }


    public function categoryStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191|unique:categories,title,NULL,id,deleted_at,NULL',
        ]);
        $category = new Category();
        $category->title = $request->title;
        if ($category->save()) {
            session()->flash('success', 'Category has been created successfully');
            return redirect('category');
        } else {
            return back()->with('error', 'Error while creating category');
        }
    }

    public function categoryEdit($id)
    {
        if ($id > 0) {
            $category = Category::find($id);
            $title = 'Edit Category';
            $key = 'Edit';
            return view('Admin.category.add', compact('title', 'key', 'category'));
        } else {
            return back()->with('error', 'Error category ID not Found');
        }
    }


    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191|unique:categories,title,' . $id . ',id,deleted_at,NULL',
        ]);
        $category = Category::find($id);
        $category->title = $request->title;
        if ($category->save()) {
            session()->flash('success', 'Category has been updated successfully');
            return redirect('category');
        } else {
            return back()->with('error', 'Error while creating category');
        }
    }

    public function deleteCategory($id)
    {
        if ($id > 0) {
            $category = Category::find($id);
            if ($category->delete()) {
                echo(json_encode(array('status' => true)));
            } else {
                echo(json_encode(array('status' => false, 'message' => 'Some error occured,please try after sometime')));
            }
        }
    }
}
