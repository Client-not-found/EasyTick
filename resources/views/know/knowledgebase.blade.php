    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | Knowledge Base</title>
    </header>

    <body>
        <div class="text-center">
            <br>
            <h3>Knowledge Base</h3>
            <p>Welcome to the knowledge base. Here you will find help articles on frequently asked topics.</p>
        </div>
        @foreach($categories as $category)
        @can('create', App\Article::class)
        <button type="button" class="btn btn-success" @click="newArticle">Create new article</button>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th scope="col-md-12">{{$category->name}}</th>
                </tr>
            </thead>
        </table>
        @foreach($articles as $article)
        @if($article->artCatId === $category->catKey)
        <div class="list-group-item list-group-item-action" aria-current="true">
            <a href="/article/{{$article->key}}">
                <div class="row">
                    <b class="col-md-12">{{$article->topic}}</b>
                </div>
            </a>
        </div>
        @endif
        @endforeach
        <br>
        <hr>
        @endforeach
    </body>
    @endsection
