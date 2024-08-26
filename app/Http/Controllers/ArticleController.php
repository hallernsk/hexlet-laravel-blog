<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articles = Article::paginate();

        $articles = Article::all();
        return ArticleResource::collection($articles); // Возвращаем статьи в виде ресурса (api) (Postman)

        // return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('test-create-for-postman');
        $article = new Article();
        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:10',
        ]);

        $article = new Article();

        // Заполнение статьи данными из формы
        $article->fill($data);
        // При ошибках сохранения возникнет исключение

        return new ArticleResource($article); // Возвращаем созданную статью в виде ресурса (api)

        $article->save();
        flash('Cтатья добавлена в БД.');
        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article = Article::findOrFail($article->id);
        return new ArticleResource($article);
        // return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // dd('test-edit-postman');
        //       $article = Article::findOrFail($id);

        return new ArticleResource($article);

        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $this->validate($request, [
        // У обновления изменённая валидация: в проверку уникальности добавляется название поля и id текущего объекта
        // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:articles,name,' . $article->id,
            'body' => 'required|min:10',
        ]);

        // $article->fill($data);  эти две строки
        // $article->save();       можно заменить одной:
        $article->update($data);
        flash('Cтатья обновлена.');
        return redirect()
            ->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        if ($article) {
            $article->delete();
        }
        flash('Cтатья удалена.');
        return new ArticleResource($article);   // Возвращаем удаленную статью в виде ресурса (api)

        return redirect()->route('articles.index');
    }
}
