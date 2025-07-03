<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Товары</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    @if (!empty($model))
                        <table>
                            <caption>Удаление товара</caption>
                            <thead>
                                <th>Код товара</th>
                                <th>Наименование</th>
                                <th>Описание</th>
                                <th>Категория</th>
                                <th>Цена</th>
                            </thead>
                            <tfoot><tr><td colspan="7">
                                <form action="/goods/{{ $model->id }}" method="POST">@method('PUT')
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="deleted" id="deleted" value="1">
                                    <input type="submit" class="btn danger" value="Удалить">
                                    <a href="javascript:history.back()"><input type="button" class="btn info" value="Отменить"></a>
                                </form>
                            </td></tr></tfoot>
                            <tbody>
                                <tr>
                                    <td>{{ $model->id }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>{{ $model->description }}</td>
                                    <td>
                                        @foreach($categories as $item)
                                            @if ($item->id == $model->category_id)
                                                {{ $item->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $model->price }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>Товар не найден</p>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
