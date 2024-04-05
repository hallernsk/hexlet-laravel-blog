@extends('layouts.app')

@section('content')

{{ Form::model($article, ['route' => 'articles.store']) }}
@include('article.form')
{{ Form::submit('Добавить', ['class' => 'btn btn-primary ml-auto']) }}
{{ Form::close() }}
@endsection
