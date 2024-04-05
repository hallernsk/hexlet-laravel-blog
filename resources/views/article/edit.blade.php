@extends('layouts.app')

@section('content')

{{ Form::model($article, ['route' => ['articles.update', $article], 'method' => 'PATCH']) }}
@include('article.form')
{{ Form::submit('Обновить', ['class' => 'btn btn-primary ml-auto']) }}
{{ Form::close() }}

@endsection
