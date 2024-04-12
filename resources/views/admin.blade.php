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
        <a class="navbar-brand" href="/">OS-OPT - {{ Auth::user()->name }}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
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
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выйти</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('modal')
    <main class="container-lg py-5 d-flex flex-column align-items-end">
        <button type="button" class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#modelId">
            Добавить
        </button>
        @yield('table')
    </main>
    <style>
        .table-image {
            height: 50px;
        }
        table {
            overflow: scroll;
        }
        .default-table-input{
            width:150px;
        }
        .clickable{
            cursor: pointer;
        }
        .image-td {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }
        .image-td.active{
            border:1px solid rgb(20, 149, 255);
        }
        table input {
            border: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        @media (max-width:992px){
            table{
                display: block;
            }
        }
    </style>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
