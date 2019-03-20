<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Neww;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\ImageDropzone;

class NewwController extends Controller
{

    public function index(Request $request)
    {


        $news = Neww:: where(function ($q) use ($request){
            return $q->when($request->search,function ($query) use ($request) {
                return $query->where('title','like','%'.$request->search.'%');
            });
        })->latest()->paginate(5);
        return view('admin.news.index',compact('news'));
    }


    public function create(Category $category)
    {
        $category = Category::all();
        return view('admin.news.create',compact('category'));
    }


    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'mainImage' => 'required',
           'cat_name' => 'required',
           'content' => 'required',
        ]);
        $news = new Neww();
        $news->title = $request->title;
//        $news->user_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $news->admin_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $news->category_id = $request->cat_name;
        $news->content =  $request->input('content');

        if ($request->mainImage) {
            Image::make($request->mainImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('upload/news/' . $request->mainImage->hashName()));

            $news->Main_Image = $request->mainImage->hashName();
        }
        $news->save();
        session()->flash('success',__('تم الاضافة بنجاح'));
        return redirect()->route('news.index');
    }


    public function show(Neww $neww,$id)
    {
        $news =  Neww::find($id);
        return view('admin.news.show',compact('news'));
    }


    public function edit(Neww $neww,$id,Category $category)
    {
        $category = Category::all();
        $editnew = Neww::findOrFail($id);
        return view('admin.news.edit',compact('editnew','category'));

    }
    public function update(Request $request, Neww $neww,$id)
    {
        $request->validate([
            'title' => 'required',
            'mainImage' => 'image',
            'cat_name' => 'required',
            'content' => 'required',
        ]);
        $news =  Neww::find($id);
        $news->title = $request->input('title');
//        $news->user_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $news->admin_id = auth()->guard('admin')->user() ?auth()->guard('admin')->user()->id : auth()->user()->id;
        $news->category_id = $request->cat_name;
        $news->content =  $request->input('content');

        if ($request->mainImage){
            if ($news->Main_Image != 'default.png'){
                Storage::disk('public_uploads')->delete('/news/'.$news->Main_Image);
            }
            Image::make($request->mainImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('upload/news/'.$request->mainImage->hashName()));

            $news->Main_Image = $request->mainImage->hashName();
        }
        $news->save();

        session()->flash('success',__('تم التعديل بنجاح'));
        return redirect()->route('news.index');
    }


    public function destroy(Neww $neww,$id)
    {
        $news =  Neww::find($id);
        if ($news->Main_Image != 'default.png'){
            Storage::disk('public_uploads')->delete('/news/'.$news->Main_Image);
        }
        $news->delete();
        session()->flash('success',__('تم الحذف بنجاح'));
        return redirect()->route('news.index');
    }
    public function upload( Request $request ,$id)
    {
        if ($request->file) {

            $path = public_path('upload/dropzone/' . $request->file->hashName());
            Image::make($request->file)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        }

        if ($path){
            $up = new ImageDropzone();
            $up->path = $request->file()->hashName();
            $up->neww_id = $id;
                $up->save();
        }

        return;

    }
}
