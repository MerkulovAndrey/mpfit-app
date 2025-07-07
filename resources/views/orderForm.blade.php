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
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <!-- форма создания заказа -->
                        <h1>Новый заказ</h1>
                        <form action="/order" method="POST">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <label for="client_name">ФИО клиента</label>
                            <input id="client_name" name="client_name" type="text" class="@error('client_name') is-invalid @enderror">
                            @error('client_name')
                                <div class="alert alert-danger">Неправильное значение</div>
                            @enderror
                            <br/>

                            <label for="comment">Комментарий клиента</label>
                            <input id="comment" name="client_comment" type="text">
                            <br/>

                            <label for="goods">Выбрать несколько товаров</label>
                            <select multiple size=5 id="goods" name="goods[]" type="number" class="@error('goods') is-invalid @enderror">
                                @foreach($catalog as $item)
                                    <option value="" disabled>====== {{ $item['category'] }} ======</option>
                                    @foreach($item['goods'] as $gItem)
                                        <option value={{ $gItem['id'] }}>{{ $gItem['name'] }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('goods')
                                <div class="alert alert-danger">Нужно выбрать товар</div>
                            @enderror
                            <br/>

                            <input type="submit" class="btn success" value="Создать">
                            <input type="reset" class="btn warning" value="Сброс">
                            <a href="javascript:history.back()"><input type="button" class="btn info" value="Отменить"></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
