<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storebook_category_tableRequest;
use App\Http\Requests\Updatebook_category_tableRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request,$next){
        if(Gate::allows('manage-categories')) return $next($request);
            abort(403,'Anda Tidak Memiliki Hak akses');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('name');
        $categories = DB::table('categories')->latest()->paginate(10);
        // Category::with('latestCategory')->get()->sortByDesc('latestCategory.created_at')->paginate(10)
        // Category::paginate(10)
        if ($filterKeyword) {
            $categories = Category::where('name', 'LIKE', "%$filterKeyword%")
                ->paginate(10);
        }
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebook_category_tableRequest $request)
    {
        $name = $request->get('name');

        $new_category = new Category;

        $new_category->name = $name;

        if ($request->file('image')) {
            $image_path = $request->file('image')
                ->Store('category_images', 'public');

            $new_category->image = $image_path;
        }

        $new_category->created_by = Auth::user()->id;
        $new_category->slug = Str::slug($name, '-');
        $new_category->save();
        return redirect()->route('categories.index')->with('status', 'categories successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryEdit = Category::findOrFail($id);

        return view('categories.edit', ['category' => $categoryEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Updatebook_category_tableRequest $request, $id)
    {
        $name = $request->get('name');
        $slug = $request->get('slug');


        $categories = Category::findorfail($id);


        $categories->name = $name;
        $categories->slug = $slug;

        if ($request->file('image')) {
            if ($categories->image && file_exists(storage_path('app/public/' . $categories->image))) {
                Storage::delete(['public/' . $categories->name]);
            }

            $new_image = $request->file('image')->store('category_images', 'public');

            $categories->image = $new_image;
        }
        $categories->updated_by = Auth::user()->id;

        $categories->slug = Str::slug($name);

        $categories->save();

        return redirect()->route('categories.edit', [$id])->with('status', 'Category Succesfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category Succesfully Move To Trash');
    }

    public function trash()
    {

        $deleteCategory = Category::onlyTrashed()->paginate(10);

        return view('categories.trash', ['categories' => $deleteCategory]);
    }


    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route('categories.index')
                ->with('status', 'Category Is not in Trash');
        }

        return redirect()->route('categories.index')->with('status', 'Category Succesfully Restored');
    }

    public function deletePermanent($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if (!$category->trashed()) {
            return redirect()->route('categories.index')
                ->with('status', 'can not delete permanent active category');
        } else {
            $category->forceDelete();

            return redirect()->route('categories.index')->with('status', 'Category Permanently delete ');
        }
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = Category::where('name', 'LIKE', "%$keyword")->get();

        return $categories;
    }
}
