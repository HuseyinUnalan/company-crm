@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Excel Ürün Yükle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ürün İşlemleri</a></li>
                                <li class="breadcrumb-item active">Excel Ürün Yükle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="container mt-2 mb-2">
                <div class="row">
                    <div class="col-md-2">
                        <a href="{{ asset('upload/ornek_urun_excel.xlsx') }}" download=""
                            class="btn btn-warning text-white">Örnek
                            Excel</a>
                    </div>
                    <div class="col-md-10">
                        <p>Kategori için A sutununda ürün kategorileri listesinde ID sutunundaki numaralar girilmeli.
                            <br>
                            Tevkifat 'VAR' ise I sutunu 1, 'YOK' ise 2 girilmeli.
                            <br>
                            Ütün tipi 'ADET' ise D sutunu 1, 'AĞIRLIK' ise 2, 'METRE' ise 3, 'DİĞER' ise 4 girilmeli.
                        </p>
                    </div>
                </div>
            </div>


            <form action="{{ route('store.product.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Excel Dosyası</label>
                                    <div class="col-sm-10">
                                        <input name="file" class="form-control" type="file" required
                                            accept=".xlsx, .xls">
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
@endsection
