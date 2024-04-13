@extends('admin')

@section('table')
    <table class="table">
        <thead>
            <tr>
                <th>Категория</th>
                <th>Подкатегория</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Цена</th>
                <th>В упаковке</th>
                <th>В наличии</th>
                <th>Управление</th>
            </tr>
        </thead>
        <tbody>
            @if (count($rows) > 0)
                @foreach ($rows as $row)
                    <form enctype="multipart/form-data" action="{{ '/' . $table . '/edit/' . $row->id }}" method="post">
                        @csrf
                        <input type="hidden" name="table" value="{{ $table }}">
                        <tr>
                            <td>
                                <select oninput="categoryChanged(this)" data-sc="#sc_select_{{ $row->id }}"
                                    name="category_id" class="c_select">
                                    @foreach ($categories as $category)
                                        <option @if ($category->id == $row->category_id) selected @endif
                                            value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="subcategory_id" id="sc_select_{{ $row->id }}">
                                    @foreach ($subcategories as $subcategory)
                                        <option @if ($subcategory->id == $row['subcategory_id']) selected @endif
                                            data-cid="{{ $subcategory->category_id }}" value="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input name="name" required value="{{ $row['name'] }}" class="default-table-input"
                                    type="text">
                            </td>
                            <td class="image-td">
                                @if ($row['image'])
                                    <img class="table-image clickable"
                                        onclick="document.getElementById('image_{{ $row->id }}').click()"
                                        src="{{ $row['image'] }}" loading="lazy">
                                    <input name="image" type="file" class="d-none" id="image_{{ $row->id }}"
                                        accept="image/*">
                                @else
                                    <input name="image" required type="file" accept="image/*">
                                @endif
                            </td>
                            <td>
                                <input name="price" required value="{{ $row['price'] }}" class="default-table-input"
                                    type="text">
                            </td>
                            <td>
                                <input name="count" value="{{ $row['count'] }}" class="default-table-input" type="number">
                            </td>
                            <td>
                                <input name="in_stock" required value="{{ $row['in_stock'] }}" class="default-table-input"
                                    maxlength="1" type="text">
                            </td>
                            <td>
                                <input type="submit" name="save" value="Сохранить">
                                <input type="submit" name="delete" value="Удалить">
                            </td>
                        </tr>
                    </form>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection


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
                                <select required name="category_id" class="c_select" data-sc="#sc_select_add"
                                    oninput="categoryChanged(this)">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Подкатегория</label>
                                <select required name="subcategory_id" id="sc_select_add">
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
                                <input type="file" required id="add_file_input" accept="image/*" class="form-control"
                                    name="image">
                            </div>
                            <div class="form-group">
                                <label>Цена</label>
                                <input required type="text" name="price">
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
    
@endsection
