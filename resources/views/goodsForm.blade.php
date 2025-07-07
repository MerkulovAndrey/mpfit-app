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
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @if (empty($model))
                            <!-- форма создания товара -->
                            <h1>Новый товар</h1>
                            <form action="/goods" method="POST">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <label for="name">Наименование</label>
                                <input id="name" name="name" type="text" class="@error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">Неправильное значение</div>
                                @enderror
                                <br/>

                                <label for="description">Описание</label>
                                <input id="description" name="description" type="text" class="@error('description') is-invalid @enderror">
                                @error('description')
                                    <div class="alert alert-danger">Неправильное значение</div>
                                @enderror
                                <br/>

                                <label for="price">Цена</label>
                                <input id="price" name="price" type="number" class="@error('price') is-invalid @enderror">
                                @error('price')
                                    <div class="alert alert-danger">Неправильное значение</div>
                                @enderror
                                <br/>
                                <label for="category">Категория товара</label>
                                <select id="category" name="category_id" type="number">
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <br/>

                                <input type="submit" class="btn success" value="Создать">
                                <input type="reset" class="btn warning" value="Сброс">
                                <a href="javascript:history.back()"><input type="button" class="btn info" value="Отменить"></a>
                            </form>
                            
                        @else
                            <!-- форма редактирования товара -->
                             <h1>Редактирование<br/> товара</h1>
                            <form action="/goods/{{ $model->id }}" method="POST">@method('PUT')
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <label for="name">Наименование</label>
                                <input id="name" name="name" type="text" value="{{ $model->name }}" class="@error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">Неправильное значение</div>
                                @enderror
                                <br/>

                                <label for="description">Описание</label>
                                <input id="description" name="description" type="text" value="{{ $model->description }}" class="@error('description') is-invalid @enderror">
                                @error('description')
                                    <div class="alert alert-danger">Неправильное значение</div>
                                @enderror
                                <br/>

                                <label for="price">Цена</label>
                                <input id="price" name="price" type="number" value="{{ $model->price }}" class="@error('price') is-invalid @enderror">
                                @error('price')
                                    <div class="alert alert-danger">Неправильное значение</div>
                                @enderror
                                <br/>

                                <br/>
                                <label for="category">Категория товара</label>
                                <select id="category" name="category_id" type="number">
                                    @foreach($categories as $item)
                                        @if ($item->id == $model->category_id)
                                            <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br/>
                                
                                <input type="submit" class="btn success" value="Сохранить">
                                <input type="reset" class="btn warning" value="Сброс">
                                <a href="javascript:history.back()"><input type="button" class="btn info" value="Отменить"></a>
                            </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
