@extends('layouts.app')

@section('content')
    @include('flash::message')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2><a href="{{ route('articles.show', $article) }}">{{$article->name}}</a></h2>
         {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
        <div>{{Str::limit($article->body, 200)}}</div>
        <a href="{{ route('articles.edit', $article) }}">Редактировать</a>
    @endforeach
@endsection
