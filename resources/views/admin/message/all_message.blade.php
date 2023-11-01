@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Mesaj Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Mesaj Listesi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



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
                                                    <th>Ad Soyad</th>
                                                    <th>Mail</th>
                                                    <th>Durum</th>
                                                    <th>Tarih</th>
                                                    <th>İşlemler</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                                @php($i = 1)

                                                @foreach ($messages as $item)
                                                    <tr class="odd">


                                                        <td> {{ $i++ }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>
                                                            @if ($item->read_status == 0)
                                                                <div class="font-size-13">
                                                                    <i
                                                                        class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>
                                                                    Not Readed
                                                                </div>
                                                            @else
                                                                <div class="font-size-13">
                                                                    <i
                                                                        class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                                    Readed
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('detail.message', $item->id) }}">
                                                                <button class="btn btn-primary btn-sm">
                                                                    <i class="far fa-eye"></i>
                                                                </button>
                                                            </a>

                                                            <a href="mailto:{{ $item->mail }}">
                                                                <button class="btn btn-success btn-sm">
                                                                    <i class="fas fa-mail-bulk"></i>
                                                                </button>
                                                            </a>

                                                            <a href="{{ route('delete.message', $item->id) }}"
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
