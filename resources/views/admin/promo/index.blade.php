@extends('layouts.admin')

@section('title')
    Promo
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h6 class="text-uppercase mb-0">Promo</h6>
            <hr />
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <a class="btn btn-primary mb-3" href="javascript:void(0)" id="createNewPromo">
                            <i class="fa-regular fa-square-plus"></i>
                        </a>
                        <a class="btn btn-danger mb-3" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#deleteAllPromoModal">
                            Delete All
                        </a>
                        <table class="table-striped table-bordered data-table table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Type Promo</th>
                                    <th>Info Promo</th>
                                    <th>Harga Promo</th>
                                    <th>Yang Upload</th>
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

    @include('admin.promo.create')
    @include('admin.promo.delete')
    @include('admin.promo.delete_all')
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
                ajax: "{{ route('admin.promo.index') }}",
                language: {
                    processing: "" // Ensure no message is shown
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_mulai_promo',
                        name: 'tanggal_mulai_promo'
                    },
                    {
                        data: 'tanggal_akhir_promo',
                        name: 'tanggal_akhir_promo'
                    },
                    {
                        data: 'type_promo',
                        name: 'type_promo'
                    },
                    {
                        data: 'info_promo',
                        name: 'info_promo'
                    },
                    {
                        data: 'harga_promo',
                        name: 'harga_promo',
                        render: function(data, type, row) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: 'admin.name',
                        name: 'admin.name'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="javascript:void(0)" data-id="' + data +
                                '" class="edit btn btn-warning me-2 btn-sm"><i class="fa-solid fa-pen-to-square text-white"></i></a>' +
                                '<a href="javascript:void(0)" data-id="' + data +
                                '" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash text-white"></i></a>';
                        }
                    }
                ]
            });
            // Function to fetch data without reload
            function fetchPromo() {
                table.ajax.reload(null, false); // user paging is not reset on reload
            }

            // Set interval to fetch data every 1 seconds
            setInterval(fetchPromo, 1000);

            $('#createNewPromo').click(function() {
                $('#saveCreateBtn').val("create-promo");
                $('#id').val('');
                $('#createPromoForm').trigger("reset");
                $('#createPromoModal').modal('show');
            });

            $('#saveCreateBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#createPromoForm').serialize(),
                    url: "{{ route('admin.promo.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#createPromoForm').trigger("reset");
                        $('#createPromoModal').modal('hide');
                        table.draw();
                        $('#saveCreateBtn').html('Save Changes');
                        toastr.success(data.success, 'Sukses!');
                    },
                    error: function(data) {
                        var errors = data.responseJSON.errors;
                        $('#createPromoForm .text-danger').html('');
                        $.each(errors, function(key, value) {
                            $('#' + key + '_create_error').html(value[0]);
                        });
                        $('#saveCreateBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.promo.index') }}" + '/' + id + '/edit', function(data) {
                    $('#editPromoModal').modal('show');
                    $('#id_edit').val(data.id);
                    $('#tanggal_mulai_promo_edit').val(data.tanggal_mulai_promo);
                    $('#tanggal_akhir_promo_edit').val(data.tanggal_akhir_promo);
                    $('#type_promo_edit').val(data.type_promo);
                    $('#info_promo_edit').val(data.info_promo);
                    $('#harga_promo_edit').val(data.harga_promo);
                })
            });

            $('#saveEditBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                var id = $('#id_edit').val();

                $.ajax({
                    data: $('#editPromoForm').serialize(),
                    url: "{{ route('admin.promo.update', '') }}" + '/' + id,
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        $('#editPromoForm').trigger("reset");
                        $('#editPromoModal').modal('hide');
                        table.draw();
                        $('#saveEditBtn').html('Save Changes');
                        toastr.success(data.success, 'Sukses!');
                    },
                    error: function(data) {
                        var errors = data.responseJSON.errors;
                        $('#editPromoForm .text-danger').html('');
                        $.each(errors, function(key, value) {
                            $('#' + key + '_edit_error').html(value[0]);
                        });
                        $('#saveEditBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.delete', function() {
                var id = $(this).data("id");
                var url = "{{ route('admin.promo.destroy', '') }}" + '/' + id;

                $('#deletePromoForm').attr('action', url);
                $('#deletePromoModal').modal('show');
            });

            $('#deletePromoForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(res) {
                        if (res.status === 200) {
                            table.draw();
                            $('#deletePromoModal').modal('hide');
                            toastr.success('Promo deleted successfully!', 'Sukses!');
                        } else {
                            toastr.error('Failed to delete data!', 'Error!');
                        }
                    },
                    error: function(data) {
                        toastr.error('Terjadi kesalahan, silakan coba lagi.', 'Error!');
                    }
                });
            });

            $('#deletePromoModal').on('hidden.bs.modal', function() {
                $('#deletePromoForm').trigger('reset');
            });
            $('#deletePromoModal').on('click', '[data-dismiss="modal"]', function() {
                $('#deletePromoModal').modal('hide');
            });
            $('#deleteAllPromoModal').on('show.bs.modal', function(event) {
                $('#deleteAllPromoForm').attr('action', '{{ route('admin.promo.deleteAll') }}');
            });

            $('#deleteAllPromoForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status === 200) {
                            table.draw();
                            $('#deleteAllPromoModal').modal('hide');
                            toastr.success('All Promo deleted successfully!', 'Sukses!');
                        } else {
                            toastr.error(res.message, 'Error!');
                        }
                    },
                    error: function(data) {
                        toastr.error('Terjadi kesalahan, silakan coba lagi.', 'Error!');
                    }
                });
            });

            function formatRupiah(angka) {
                var number_string = angka.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                return 'Rp. ' + rupiah;
            }
        });
    </script>
@endsection
