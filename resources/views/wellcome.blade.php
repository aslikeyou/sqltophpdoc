@extends('layout')

@section('content')
    <div class="starter-template">
        <h1>Sql to PHPDoc</h1>
        <p class="lead">Вставь текст в форму ниже, нажми на кнопку и радуйся готовому phpdoc'у для твоей модели</p>
        <form method="post">
            <div class="form-group">
                <label for="sqlBlockId">Sql для парсинга</label>
                <textarea id="sqlBlockId" name="sqlcode" class="form-control" rows="3">{{ $sqlcode or ''}}</textarea>
            </div>


            @if isset($parsed)
                <pre style="text-align: left">{{ $parsed }}</pre>
            @endif
            <button type="submit" class="btn btn-default">Парсить</button>
        </form>
    </div>
@endsection