@extends('admin')
@section('table')
    <table class="table">
        <thead>
            <tr>
                <th>
                    Контакт
                </th>
                <th>
                    Пользователь
                </th>
                <th>
                    Тип оплаты
                </th>
                <th>
                    Статус заказа
                </th>
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
                                <input name="phone" value="{{$row->phone}}" required type="text">
                            </td>
                            <td>
                                <input name="user_id" value="{{$row->user_id}}" type="text">
                            </td>
                            <td>
                                <input name="payment_type" value="{{$row->payment_type}}" required type="text">
                            </td>
                            <td>
                                <input name="status_id" value="{{$row->status_id}}" required type="text">
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
                                        <input type="text" class="form-control" name="{{ $column }}" placeholder>
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
