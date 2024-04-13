@extends('admin')
@section('table')
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Категория</th>
                <th>Название</th>
                <th>Управление</th>
            </tr>
        </thead>
        <tbody>
            @if (count($rows) > 0)
                @foreach ($rows as $row)
                    <form action="{{ '/' . $table . '/edit/' . $row->id }}" method="post">
                        @csrf
                        <input type="hidden" name="table" value="{{ $table }}">
                        <tr>
                            <td>
                                <input name="id" required value="{{ $row->id }}" type="text">
                            </td>
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
                                <input name="name" required value="{{ $row->name }}" type="text">
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
                                <select name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" name="name">
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
