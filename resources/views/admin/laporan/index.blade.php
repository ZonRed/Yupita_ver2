@extends('layouts.admin')

@section('title')
    Laporan
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h6 class="text-uppercase mb-0">Laporan</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <button class="btn btn-danger mb-3" id="deleteAllLaporan">Delete All</button>
                        <table class="table-striped table-bordered data-table table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Laporan</th>
                                    <th>Email Laporan</th>
                                    <th>Pesan Laporan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.laporan.delete')
    @include('admin.laporan.delete_all')
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('admin.laporan.index') }}",
                language: {
                    processing: "" // Ensure no message is shown
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_laporan',
                        name: 'nama_laporan'
                    },
                    {
                        data: 'email_laporan',
                        name: 'email_laporan',
                        render: function(data, type, row) {
                            return '<a href="https://mail.google.com/mail/?view=cm&fs=1&to=' + row.email_laporan + '" target="_blank">' + row.email_laporan + '</a>';
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pesan_laporan',
                        name: 'pesan_laporan'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="javascript:void(0)" data-id="' + data +
                                '" class="deleteLaporan btn btn-danger btn-sm"><i class="fa-solid fa-trash text-white"></i></a>';
                       }
                    }
                ]
            });

            function fetchLaporan() {
                table.ajax.reload(null, false);
            }

            setInterval(fetchLaporan, 1000);

            var deleteId = null;

            $(document).on('click', '.deleteLaporan', function() {
                deleteId = $(this).data('id');
                var url = "{{ route('admin.laporan.destroy', '') }}" + '/' + deleteId;
                $('#deleteLaporanForm').attr('action', url);
                $('#deleteLaporanModal').modal('show');
            });

            $('#deleteLaporanForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(res) {
                        if (res.status === 200) {
                            table.draw();
                            $('#deleteLaporanModal').modal('hide');
                            toastr.success('Laporan deleted successfully!', 'Sukses!');
                        } else {
                            toastr.error('Failed to delete data!', 'Error!');
                        }
                    },
                    error: function(data) {
                        toastr.error('Terjadi kesalahan, silakan coba lagi.', 'Error!');
                    }
                });
            });

            $('#deleteLaporanModal').on('hidden.bs.modal', function() {
                $('#deleteLaporanForm').trigger('reset');
            });

            $('#deleteLaporanModal').on('click', '[data-dismiss="modal"]', function() {
                $('#deleteLaporanModal').modal('hide');
            });

            $('#deleteAllLaporan').click(function() {
                $('#deleteAllLaporanModal').modal('show');
            });

            $('#deleteAllLaporanForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.laporan.deleteAll') }}",
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status === 200) {
                            table.draw();
                            $('#deleteAllLaporanModal').modal('hide');
                            toastr.success('All Laporan deleted successfully!', 'Sukses!');
                        } else {
                            toastr.error('Failed to delete all data!', 'Error!');
                        }
                    },
                    error: function(data) {
                        toastr.error('Terjadi kesalahan, silakan coba lagi.', 'Error!');
                    }
                });
            });
        });
    </script>
@endsection
