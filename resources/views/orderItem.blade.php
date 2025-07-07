<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Заказы</title>

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
                            <caption>Информация о заказе</caption>
                            <thead>
                                <th>Номер заказа</th>
                                <th>Дата создания</th>
                                <th>ФИО покупателя</th>
                                <th>Комментарий</th>
                                <th>Список товаров</th>
                                <th>Цена</th>
                                <th>Статус заказа</th>
                            </thead>
                            <tfoot><tr><td colspan="7">
                                <a href="javascript:history.back()"><div class="btn info" style="text-align: center;">Назад</div></a>
                            </td></tr></tfoot>
                            <tbody>
                                <tr>
                                    <td>{{ $model->id }}</td>
                                    <td>{{ $model->created_at }}</td>
                                    <td>{{ $model->client_name }}</td>
                                    <td>{{ $model->client_comment }}</td>
                                    <td>
                                        @if (isset($model->goods[0]))
                                                @foreach($model->goods as $item)
                                                    {{ $item }}<br/>
                                                @endforeach
                                        @else
                                            нет
                                        @endif
                                        <div style="border-bottom: solid 1px #000000;">&nbsp;</div>
                                        Итого:
                                    </td>
                                    <td style="text-align: right;">                                        
                                        @if (isset($model->prices[0]))
                                                @foreach($model->prices as $item)
                                                    {{ $item }}<br/>
                                                @endforeach
                                        @else
                                            0
                                        @endif
                                        <div style="border-bottom: solid 1px #000000;">&nbsp;</div>
                                        {{ $model->full_price }}
                                    </td>
                                    <td>
                                        {{ $model->status }}
                                        @if ($model->status == 'новый')
                                            <form method="POST" action="/order/{{$model->id}}">@method('PUT')
                                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="status" value="выполнен">
                                                <input type="submit" class="btn success" value="Заменить на выполнен">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>Заказ не найден</p>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
