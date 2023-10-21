@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ürün Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ürün İşlemleri </a></li>
                                <li class="breadcrumb-item active">Ürün Listesi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            {{-- <form action="" method="POST">
                @csrf
                <div class="container mt-2 mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="İskonto Güncelle">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">İskonto Güncelle</button>
                        </div>
                    </div>
                </div>
            </form> --}}


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">



                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable"
                                            class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                            style="border-collapse: collapse; border-spacing: 0px; width: 100%;"
                                            role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Ad</th>
                                                    <th>Birim Fiyat</th>
                                                    <th>% KDV</th>
                                                    <th>İşlemler</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                                @php($i = 1)

                                                @foreach ($products as $item)
                                                    <tr class="odd">
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->unit_price }}</td>
                                                        <td>
                                                            @if ($item->withholding_status == 1)
                                                                {{ $item->kdv / 2 }} (Tevkifat Var)
                                                            @else
                                                                {{ $item->kdv }}
                                                            @endif
                                                        </td>


                                                        <td>
                                                            <a href="{{ route('edit.product', $item->id) }}">
                                                                <button class="btn btn-primary btn-sm">
                                                                    <i class="far fa-edit"></i>
                                                                </button>
                                                            </a>

                                                            <a href="{{ route('delete.product', $item->id) }}"
                                                                id="delete">
                                                                <button class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </a>

                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->








        </div> <!-- container-fluid -->
    </div>
@endsection
