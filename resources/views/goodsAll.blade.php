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
                <div class="topper mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <a href="/">В начало</a>&nbsp;&nbsp;&nbsp;Товары&nbsp;&nbsp;&nbsp;<a href="/order">Заказы</a>
                </div>
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <table>
                        <caption>Список товаров</caption>
                        <thead>
                            <th>Код товара</th>
                            <th>Наименование</th>
                            <th>Категория</th>
                            <th>Цена</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tfoot><tr><td colspan="7">
                            <a href="goods/create"><div class="btn primary" style="text-align: center;">Новый товар</div></a>
                        </td></tr></tfoot>
                        <tbody>
                            @foreach($goods as $model)
                                <tr>
                                    <td>{{ $model->id }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>
                                        @foreach($categories as $item)
                                            @if ($item->id == $model->category_id)
                                                {{ $item->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $model->price }}</td>
                                    <td><div class="btn success"><a href="goods/{{ $model->id }}">Подробнее</a></div></td>
                                    <td><div class="btn primary"><a href="goods/{{ $model->id }}/edit">Редактирование</a></div></td>
                                    <td><div class="btn danger"><a href="goods/{{ $model->id }}/delete">Удалить</a></div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </body>
</html>
