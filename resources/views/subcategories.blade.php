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
