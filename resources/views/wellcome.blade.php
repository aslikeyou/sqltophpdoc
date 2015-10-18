@extends('layout')

@section('content')
    <div class="starter-template">
        <h1>Sql to PHPDoc</h1>
        <p class="lead">Вставь текст в форму ниже, нажми на кнопку и радуйся готовому phpdoc'у для твоей модели</p>
        <form method="post">
            <div class="form-group">
                <label for="sqlBlockId">Sql (CREATE TABLE) для парсинга</label>
                <textarea id="sqlBlockId" name="sqlcode" class="form-control" rows="3" placeholder="CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;">{{ $sqlcode or ''}}</textarea>
            </div>


            @if (isset($parsed))
                <pre style="text-align: left">{{ $parsed }}</pre>
            @endif
            <button type="submit" class="btn btn-default">Парсить</button>
        </form>
    </div>
@endsection