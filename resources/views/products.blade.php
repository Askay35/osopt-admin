@extends('admin')
@section('modal')
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="container-fluid" enctype="multipart/form-data" action="{{ "/$table" }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Добавить элемент</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label>Категория</label>
                                <select required name="category_id" id="c_select" oninput="categoryChanged(this)">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Подкатегория</label>
                                <select required name="subcategory_id" id="sc_select">
                                    @foreach ($subcategories as $subcategory)
                                        <option data-cid="{{ $subcategory->category_id }}" value="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" required name="name">
                            </div>
                            <div class="form-group">
                                <label>Изображение</label>
                                <input type="file" id="add_file_input" accept="image/*" class="form-control"
                                    name="image">
                            </div>
                            <div class="form-group">
                                <label>Цена</label>
                                <input required type="number" name="price">
                            </div>
                            <div class="form-group">
                                <label>В наличии</label>
                                <select name="in_stock">
                                    <option selected value="1">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function hideSubcategories(cid) {
            let options = document.querySelectorAll("#sc_select option");
            for (const i of options) {
                i.classList.add("d-none");
            }
            let visible_options = document.querySelectorAll("#sc_select option[data-cid=\"" + cid + "\"]");
            for (const i of visible_options) {
                i.classList.remove('d-none');
            }
            document.querySelector("#sc_select").value = visible_options[0].value;
        }
        hideSubcategories(document.querySelector("#c_select").value);

        function categoryChanged(e) {
            let cid = e.value;
            hideSubcategories(cid);
        }

        let file_inp = document.getElementById('add_file_input');

        window.addEventListener('paste', e => {
            file_inp.files = e.clipboardData.files;
        });
    </script>
@endsection
