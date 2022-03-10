<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;


class CategoryController extends Controller
{
    public function showCategories () {
        return view('know.knowledgebase', [
            'categories' => Category::where( "active", '=', 1)->get(),
            'articles' => Article::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function admin() {
        $this->authorize('create', User::class);
        return view('acp.knowledgebase',[
            'categories' => Category::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
    }

    public function categoryDetails(Request $request, int $id)
    {
        $this->authorize('create', User::class);
        return view('acp.categorydetails', [
            'category' => Category::where( "key", $id )->first(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);

    }

    public function newCategory () {
        $this->authorize('create', User::class);
        return view('acp.newcategory', [
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function acpEdit ( Request $request, int $id ) {
        $this->authorize('update', Category::class);
        $request->validate([
            'category' => 'required',
            'active' => 'required',
        ]);

        DB::table('categories')
            ->where('key', '=', $request->id)
            ->update(['name' => $request->category,
            'active' => $request->active]);

        return view('acp.knowledgebase',[
            'categories' => Category::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);

    }

    public function acpDelete ( Request $request, int $id ) {
        $this->authorize('delete', Category::class);
        DB::table('categories')->where('key', '=', $request->id )->delete();

        return view('acp.knowledgebase',[
            'categories' => Category::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function acpSave ( Request $request ) {
        $this->authorize('create', Category::class);
        Category::create([
            'name' => $request->category,
            'active' => $request->active,
        ]);

        return view('acp.knowledgebase',[
            'categories' => Category::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }
}
