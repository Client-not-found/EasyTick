<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function newArticle () {
        return view('know.newarticle',[
            'categories' => Category::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
    }

    
    public function save ( Request $request ) {
        $this->authorize('create', Article::class);
        //dd($request->category);
        Article::create([
            'useId' => auth()->user()->key,
            'catId' => $request->category,
            'topic' => $request->title, 
            'message' => $request->message,
        ]);   


        return view('know.knowledgebase', [
            'categories' => Category::where( "active", '=', 1)->get(),
            'articles' => Article::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function artDelete ( Request $request, int $id ) {

    $this->authorize('delete', Article::class);
        DB::table('articles')->where('key', '=', $request->id )->delete();

        return view('know.knowledgebase', [
            'categories' => Category::where( "active", '=', 1)->get(),
            'articles' => Article::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function articleDetails(Request $request, int $id)
    {

        return view('know.article', [
            'all' => Article::where( "articles.key", $id )->join('users', 'articles.useId', '=', 'users.key')->join('groups', 'users.groId', '=', 'groups.key')->first(),
            'article' => Article::where( "key", $id )->first(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);

    }
}
