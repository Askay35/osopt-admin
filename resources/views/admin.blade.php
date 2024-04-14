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
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('products') ? "active" : "" }}" href="/products">Продукты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('orders') ? "active" : "" }}" href="/orders">Заказы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('') ? "active" : "" }}" href="/">Категории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('subcategories') ? "active" : "" }}" href="/subcategories">Подкатегории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('brands') ? "active" : "" }}" href="/brands">Бренды</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выйти</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('modal')
    <main class="container-lg py-5 d-flex flex-column align-items-end">
        <button type="button" class="btn btn-success btn" data-bs-toggle="modal" data-bs-target="#modelId">
            Добавить
        </button>
        @yield('table')
        {{ $rows->links() }}
    </main>
    <style>
        .table-image {
            height: 50px;
        }

        table {
            overflow: scroll;
        }

        .default-table-input {
            width: 150px;
        }

        .clickable {
            cursor: pointer;
        }

        .image-td {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .image-td.active {
            border: 1px solid rgb(20, 149, 255);
        }

        table input {
            border: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        @media (max-width:992px) {
            table {
                display: block;
            }
        }
    </style>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function hideSubcategories(cid, sc) {
            let options = document.querySelectorAll(sc + " option");
            for (const i of options) {
                i.classList.add("d-none");
            }
            let visible_options = document.querySelectorAll(sc + " option[data-cid=\"" + cid + "\"]");
            for (const i of visible_options) {
                i.classList.remove('d-none');
            }
            document.querySelector(sc).value = visible_options[0].value;
        }

        window.onload = () => {
            let cselects = document.getElementsByClassName("c_select");
            for (let cs of cselects) {

                let options = document.querySelectorAll(cs.dataset.sc + " option");
                for (const i of options) {
                    i.classList.add("d-none");
                }
                let visible_options = document.querySelectorAll(cs.dataset.sc + " option[data-cid=\"" + cs.value +
                    "\"]");
                for (const i of visible_options) {
                    i.classList.remove('d-none');
                }
            }

            let image_columns = document.getElementsByClassName("image-td");
            let selected_image = null;

            for (const ic of image_columns) {
                ic.onclick = () => {
                    if (ic.classList.contains('active')) {
                        selected_image = null;
                        ic.classList.remove('active');
                    } else {
                        for (const i of image_columns) {
                            i.classList.remove('active');
                        }
                        selected_image = ic.querySelector('input');
                        ic.classList.add('active');
                    }

                }
            }

            let file_inp = document.getElementById('add_file_input');

            window.addEventListener('paste', e => {
                if (document.body.classList.contains('modal-open')) {
                    file_inp.files = e.clipboardData.files;
                } else if (selected_image != null) {
                    selected_image.files = e.clipboardData.files;
                }
            });
        }


        function categoryChanged(e) {
            hideSubcategories(e.value, e.dataset.sc);
        }
    </script>
</body>

</html>
