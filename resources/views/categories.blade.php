@extends('admin')

@section('table')
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
                            <img class="table-image" src="{{$column}}">
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
@endsection

@section('modal')
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="container-fluid" enctype="multipart/form-data" action="{{ "/$table" }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Добавить элемент</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @foreach ($columns as $column)
                                @if ($column == 'image')
                                    <div class="form-group mt-2">
                                        <label>{{ $column }}</label>
                                        <input type="file" id="add_file_input" accept="image/*" class="form-control"
                                            name="{{ $column }}">
                                    </div>
                                @elseif ($column != 'id')
                                    <div class="form-group mt-2">
                                        <label>{{ $column }}</label>
                                        <input type="text" class="form-control" name="{{ $column }}"
                                            placeholder>
                                    </div>
                                @endif
                            @endforeach
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