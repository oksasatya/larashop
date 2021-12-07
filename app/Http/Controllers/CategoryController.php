<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
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
    public function store(Request $request)
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
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $slug = $request->get('slug');


        $category = Category::findOrFail($id);

        $category->name = $name;
        $category->slug = $slug;

        if ($request->file('image')) {
            if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
                Storage::delete(['public/' . $category->name]);
            }

            $new_image = $request->file('image')->store('category_images', 'public');

            $category->image = $new_image;
        }
        $category->updated_by = Auth::user()->id;

        $category->slug = Str::slug($name);

        $category->save();

        return redirect()->route('categories.edit', [$id])->with('status', 'Category Succesfully Create');
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
}
