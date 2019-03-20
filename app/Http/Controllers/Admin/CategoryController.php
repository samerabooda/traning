<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function index(Request $request)
    {

            $caterogries = Category::where(function ($q) use ($request) {
                return $q->when($request->search,function ($query) use($request){
                    return $query->where('name','like','%'.$request->search.'%');
                });
            })->latest()->paginate(5);


        return view('admin.category.index',compact('caterogries'));
    } // endOfIndex


    public function create()
    {

        return view('admin.category.create');
    } // endOfCreate


    public function store(Request $request)
    {

        $request->validate([
           'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
//        $category->user_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $category->admin_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $category->name = $request->input('name');
        $category->save();

        session()->flash('success',__('تم الاضافة بنجاح'));
        return redirect()->route('categories.index');

    } //endOfStore


    public function show(Category $category)
    {
        $category = Category::findOrFail($category->id);
        return view('admin.category.show',compact('category'));

    }//EndOfShow

    public function edit(Category $category)
    {

        $caterogries = Category::findOrFail($category->id);
        return view('admin.category.edit',compact('caterogries'));

    }//endOfEdit


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ],
        ]);

        $category = Category::find($category->id);
//        $category->user_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $category->admin_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $category->name = $request->input('name');
        $category->save();

        session()->flash('success',__('تم التعديل بنجاح'));
        return redirect()->route('categories.index');
    }//endOfUpdate

    public function destroy(Category $category)
    {
        $categores  = Category::find($category->id);
        $categores->delete();

        session()->flash('success',__('تم الحذف بنجاح'));
        return redirect()->route('categories.index');

    }//endOfDestroy
}
