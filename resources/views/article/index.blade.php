@extends('layouts.app')

@section('content')
    @include('flash::message')
    <a href="{{ route('articles.create') }}">Добавить статью</a>
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2><a href="{{ route('articles.show', $article) }}">{{$article->name}}</a></h2>
        <div>{{Str::limit($article->body, 200)}}</div>
        <a href="{{ route('articles.edit', $article) }}">Редактировать</a>
        <a href="{{ route('articles.destroy', $article) }}" data-confirm="Вы уверены?" class="text-danger"
           data-method="delete" rel="nofollow">Удалить</a>
    @endforeach
@endsection
