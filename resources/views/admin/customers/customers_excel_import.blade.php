@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Excel Müşteri Yükle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Müşteri İşlemleri</a></li>
                                <li class="breadcrumb-item active">Excel Müşteri Yükle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="container mt-2 mb-2">
                <div class="row">
                    <div class="col-md-2">
                        <a href="{{ asset('upload/ornek_musteri_excel.xlsx') }}" download=""
                            class="btn btn-warning text-white">Örnek
                            Excel</a>
                    </div>
                </div>
            </div>


            <form action="{{ route('store.customer.excel') }}" method="POST" enctype="multipart/form-data">
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
