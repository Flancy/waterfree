<div class="modal fade" id="modalAdminAddProduct" tabindex="-1" role="dialog" aria-labelledby="modalAdminAddProductLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавление товара</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.products.store') }}" class="modal-body" enctype="multipart/form-data">
                <div class="form-row">
                    @csrf
                    <div class="form-group col-md-12">
                        <input type="text" name="name" placeholder="Введите название товара" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <textarea type="text" name="description" placeholder="Введите описание товара" class="form-control" id="productMDE"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="number" name="price" placeholder="Введите цену товара" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <select class="custom-select form-control" name="liter" placeholder="Выберите литраж">
                            <option value="0,33">0,33 л</option>
                            <option value="1,5">1,5 л</option>
                            <option value="2">2 л</option>
                            <option value="5">5 л</option>
                            <option value="19">19 л</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <select class="custom-select form-control" name="city_id" placeholder="Выберите город">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <select class="custom-select form-control" name="firm_id" placeholder="Выберите фирму">
                            @foreach($firms as $firm)
                                <option value="{{ $firm->id }}">{{ $firm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="custom-file" id="logoProduct" lang="ru">
                            <input type="file" name="logo" class="custom-file-input" id="logoInputProduct" aria-describedby="fileHelp">
                            <label class="custom-file-label" for="logoInputProduct">
                               Выберите логотип...
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="checkbox" name="hit" value="1"> Хит продаж
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Добавить фирму</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>