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
                    <table>
                        <caption>Список заказов</caption>
                        <thead>
                            <th>Номер заказа</th>
                            <th>Время создания</th>
                            <th>ФИО покупателя</th>
                            <th>Статус</th>
                            <th>Итоговая цена</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tfoot><tr><td colspan="7">
                            <a href="order/create"><div class="btn primary" style="text-align: center;">Новый заказ</div></a>
                        </td></tr></tfoot>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->client_name }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->full_price }}</td>
                                    <td><div class="btn success"><a href="order/{{ $order->id }}">Подробнее</a></div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </body>
</html>
