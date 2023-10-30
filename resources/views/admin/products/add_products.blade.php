@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ürün Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ürün İşlemleri</a></li>
                                <li class="breadcrumb-item active">Ürün Ekle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-xl"
                                            src="{{ url('upload/no_image.jpg') }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Fotoğraf</label>
                                    <div class="col-sm-10">
                                        <input id="image" name="photo" class="form-control" type="file" required>
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Ad </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text" required>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Birim Seç</label>
                                    <div class="col-sm-10">
                                        <select name="type" class="form-select" aria-label="Default select example"
                                            required>
                                            <option value="" selected="">Seçim Yapın</option>
                                            <option value="1">Adet</option>
                                            <option value="2">Ağırlık</option>
                                            <option value="3">Metre</option>
                                            <option value="4">Diğer</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Kategori Seç</label>
                                    <div class="col-sm-10">
                                        <select name="category" class="form-select" aria-label="Default select example"
                                            required>
                                            <option value="" selected="">Seçim Yapın</option>
                                            @foreach ($productcategories as $productscategory)
                                                <option value="{{ $productscategory->id }}">{{ $productscategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Birim Fiyatı </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="entered_unit_price" type="text" required>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">İskonto </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="discount" type="number" required>
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Birim Adet / Ağırlık
                                    </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="quantity_weight" type="text" required>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Boy </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="height" type="text" required>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">KDV </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="entered_kdv" type="number" required>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tevkifat Durumu</label>
                                    <div class="col-sm-10">
                                        <select name="withholding_status" class="form-select"
                                            aria-label="Default select example" required>
                                            <option value="" selected="">Seçim Yapın</option>
                                            <option value="1">Var</option>
                                            <option value="2">Yok</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Toplu İskontodan Etkilensin mi </label>
                                    <div class="col-sm-10">
                                        <select name="general_discount_product" class="form-select"
                                            aria-label="Default select example" required>
                                            <option value="" selected="">Seçim Yapın</option>
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->



                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Kaydet">

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </form>



        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
