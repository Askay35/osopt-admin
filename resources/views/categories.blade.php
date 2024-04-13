@extends('admin')

@section('table')
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
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
                            <div class="form-group mt-2">
                                <label>Название</label>
                                <input type="text" required class="form-control" name="name">
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
