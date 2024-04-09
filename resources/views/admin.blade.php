<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <title>Admin - {{ $table }}</title>
</head>

<body>
    <nav class="container-lg navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">OS-OPT - {{ $table }}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/products">Продукты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/orders">Заказы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Категории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/subcategories">Подкатегории</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('modal')
    <main class="container-lg py-5 d-flex flex-column align-items-end">
        <button type="button" class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#modelId">
            Добавить
        </button>

        <table class="table">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <form action="{{ '/' . $table . '/edit/' . $row['id'] }}" method="post">
                        @csrf
                        <input type="hidden" name="table" value="{{ $table }}">
                        <tr>
                            @foreach ($row as $k => $column)
                                @if ($k == 'image')
                                <td class="image-td">
                                    <img src="{{$column}}">
                                    <input name="{{ $k }}" type="file" accept="image/*">
                                </td>
                                @else
                                <td>
                                    <input name="{{ $k }}" value="{{ $column }}" type="text">
                                </td>
                                @endif
                            @endforeach
                            <td>
                                <input type="submit" name="save" value="Сохранить">
                                <input type="submit" name="delete" value="Удалить">
                            </td>
                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </main>
    <style>
        table input {
            border: 0;
        }
        .form-group{
            margin-bottom:20px;
        }
    </style>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
