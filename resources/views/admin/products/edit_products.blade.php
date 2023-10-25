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

            <form action="{{ route('update.product') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="old_image" value="{{ $product->photo }}">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-xl"
                                            src="{{ !empty($product->photo) ? url($product->photo) : url('upload/no_image.jpg') }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Fotoğraf</label>
                                    <div class="col-sm-10">
                                        <input id="image" name="photo" class="form-control" type="file">
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Ad </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $product->name }}" required>
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Birim Seç</label>
                                    <div class="col-sm-10">
                                        <select name="type" class="form-select" aria-label="Default select example">
                                            <option selected="">Seçim Yapın</option>
                                            <option value="1" {{ $product->type == 1 ? 'selected' : '' }}>
                                                Adet</option>
                                            <option value="2" {{ $product->type == 2 ? 'selected' : '' }}>Ağırlık
                                            </option>
                                            <option value="3" {{ $product->type == 3 ? 'selected' : '' }}>Metre
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Birim Fiyatı </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="unit_price"
                                            value="{{ $product->unit_price }}">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Birim Adet / Ağırlık </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="quantity_weight"
                                            value="{{ $product->quantity_weight }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Boy </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="height" type="text" value="{{ $product->height }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">KDV </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="entered_kdv" type="number" value="{{ $product->entered_kdv }}">
                                    </div>
                                </div>
                                <!-- end row -->





                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tevkifat Durumu</label>
                                    <div class="col-sm-10">
                                        <select name="withholding_status" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Seçim Yapın</option>
                                            <option value="1" {{ $product->withholding_status == 1 ? 'selected' : '' }}>Var</option>
                                            <option value="2" {{ $product->withholding_status == 2 ? 'selected' : '' }}>Yok</option>
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
