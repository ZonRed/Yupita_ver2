@extends('layouts.admin')

@section('title')
    Jual
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h6 class="text-uppercase mb-0">Jual</h6>
            <hr />
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <a class="btn btn-primary mb-3" href="javascript:void(0)" id="createNewJual">
                            <i class="fa-regular fa-square-plus"></i>
                        </a>
                        <a class="btn btn-danger mb-3" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#deleteAllJualModal">
                            Delete All
                        </a>
                        <table class="table-striped table-bordered data-table table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Jual</th>
                                    <th>Type Jual</th>
                                    <th>Harga Jual</th>
                                    <th>Stock Jual</th>
                                    <th>Jumlah Jual</th>
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

    @include('admin.jual.create')
    @include('admin.jual.delete')
    @include('admin.jual.delete_all')
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
                ajax: "{{ route('admin.jual.index') }}",
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
                        data: 'tanggal_jual',
                        name: 'tanggal_jual'
                    },
                    {
                        data: 'type_jual',
                        name: 'type_jual'
                    },
                    {
                        data: 'harga_jual',
                        name: 'harga_jual',
                        render: function(data, type, row) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: 'stock_jual',
                        name: 'stock_jual'
                    },
                    {
                        data: 'jumlah_jual',
                        name: 'jumlah_jual'
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
            function fetchJual() {
                table.ajax.reload(null, false); // user paging is not reset on reload
            }

            // Set interval to fetch data every 1 seconds
            setInterval(fetchJual, 1000);


            $('#createNewJual').click(function() {
                $('#saveCreateBtn').val("create-jual");
                $('#id').val('');
                $('#createJualForm').trigger("reset");
                $('#createJualModal').modal('show');
            });

            $('#saveCreateBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#createJualForm').serialize(),
                    url: "{{ route('admin.jual.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#createJualForm').trigger("reset");
                        $('#createJualModal').modal('hide');
                        table.draw();
                        $('#saveCreateBtn').html('Save Changes');
                        toastr.success(data.success, 'Sukses!');
                    },
                    error: function(data) {
                        var errors = data.responseJSON.errors;
                        $('#createJualForm .text-danger').html('');
                        $.each(errors, function(key, value) {
                            $('#' + key + '_create_error').html(value[0]);
                        });
                        $('#saveCreateBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.jual.index') }}" + '/' + id + '/edit', function(data) {
                    $('#editJualModal').modal('show');
                    $('#id_edit').val(data.id);
                    $('#tanggal_jual_edit').val(data.tanggal_jual);
                    $('#type_jual_edit').val(data.type_jual);
                    $('#harga_jual_edit').val(data.harga_jual);
                    $('#stock_jual_edit').val(data.stock_jual);
                    $('#jumlah_jual_edit').val(data.jumlah_jual);
                })
            });

            $('#saveEditBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                var id = $('#id_edit').val();

                $.ajax({
                    data: $('#editJualForm').serialize(),
                    url: "{{ route('admin.jual.update', '') }}" + '/' + id,
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        $('#editJualForm').trigger("reset");
                        $('#editJualModal').modal('hide');
                        table.draw();
                        $('#saveEditBtn').html('Save Changes');
                        toastr.success(data.success, 'Sukses!');
                    },
                    error: function(data) {
                        var errors = data.responseJSON.errors;
                        $('#editJualForm .text-danger').html('');
                        $.each(errors, function(key, value) {
                            $('#' + key + '_edit_error').html(value[0]);
                        });
                        $('#saveEditBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.delete', function() {
                var id = $(this).data("id");
                var url = "{{ route('admin.jual.destroy', '') }}" + '/' + id;

                $('#deleteJualForm').attr('action', url);
                $('#deleteJualModal').modal('show');
            });

            $('#deleteJualForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(res) {
                        if (res.status === 200) {
                            table.draw();
                            $('#deleteJualModal').modal('hide');
                            toastr.success('Jual deleted successfully!', 'Sukses!');
                        } else {
                            toastr.error('Failed to delete data!', 'Error!');
                        }
                    },
                    error: function(data) {
                        toastr.error('Terjadi kesalahan, silakan coba lagi.', 'Error!');
                    }
                });
            });

            $('#deleteJualModal').on('hidden.bs.modal', function() {
                $('#deleteJualForm').trigger('reset');
            });
            $('#deleteJualModal').on('click', '[data-dismiss="modal"]', function() {
                $('#deleteJualModal').modal('hide');
            });
            // Delete All functionality
            $('#deleteAllJualModal').on('show.bs.modal', function(event) {
                $('#deleteAllJualForm').attr('action', '{{ route('admin.jual.deleteAll') }}');
            });

            $('#deleteAllJualForm').submit(function(e) {
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
                            $('#deleteAllJualModal').modal('hide');
                            toastr.success('All Jual deleted successfully!', 'Sukses!');
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
                return 'Rp ' + rupiah;
            }
        });
    </script>
@endsection
