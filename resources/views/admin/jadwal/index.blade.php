@extends('layouts.admin')

@section('title')
    Jadwal
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h6 class="text-uppercase mb-0">Jadwal</h6>
            <hr />
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <a class="btn btn-primary mb-3" href="javascript:void(0)" id="createNewJadwal">
                            <i class="fa-regular fa-square-plus"></i>
                        </a>
                        <a class="btn btn-danger mb-3" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#deleteAllJadwalModal">
                            Delete All
                        </a>
                        <table class="table-striped table-bordered data-table table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari Jadwal</th>
                                    <th>Buka Jadwal (WIB)</th>
                                    <th>Tutup Jadwal (WIB)</th>
                                    <th>Yang Upload</th>
                                    <th>Jadwal Input</th>
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

    @include('admin.jadwal.create')
    @include('admin.jadwal.delete')
    @include('admin.jadwal.delete_all')
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
                ajax: "{{ route('admin.jadwal.index') }}",
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
                        data: 'hari_jadwal',
                        name: 'hari_jadwal'
                    },
                    {
                        data: 'buka_jadwal',
                        name: 'buka_jadwal'
                    },
                    {
                        data: 'tutup_jadwal',
                        name: 'tutup_jadwal'
                    },
                    {
                        data: 'admin.name',
                        name: 'admin.name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            return new Date(data)
                                .toLocaleDateString();
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row) {
                            var btn = '<a href="javascript:void(0)" data-id="' + data +
                                '" class="edit btn btn-warning me-2 btn-sm"><i class="fa-solid fa-pen-to-square text-white"></i></a>';
                            btn += '<a href="javascript:void(0)" data-id="' + data +
                                '" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash text-white"></i></a>';
                            return btn;
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Function to fetch data without reload
            function fetchJadwal() {
                table.ajax.reload(null, false); // user paging is not reset on reload
            }

            // Set interval to fetch data every 1 seconds
            setInterval(fetchJadwal, 1000);

            $('#createNewJadwal').click(function() {
                $('#saveCreateBtn').val("create-jadwal");
                $('#id').val('');
                $('#createJadwalForm').trigger("reset");
                $('#createJadwalModal').modal('show');
            });

            $('#saveCreateBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#createJadwalForm').serialize(),
                    url: "{{ route('admin.jadwal.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#createJadwalForm').trigger("reset");
                        $('#createJadwalModal').modal('hide');
                        table.draw();
                        $('#saveCreateBtn').html('Save Changes');
                        toastr.success(data.success, 'Sukses!');
                    },
                    error: function(data) {
                        var errors = data.responseJSON.errors;
                        $('#createJadwalForm .text-danger').html('');
                        $.each(errors, function(key, value) {
                            $('#' + key + '_create_error').html(value[0]);
                        });
                        $('#saveCreateBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.jadwal.index') }}" + '/' + id + '/edit', function(data) {
                    $('#editJadwalModal').modal('show');
                    $('#id_edit').val(data.id);
                    $('#hari_jadwal_edit').val(data.hari_jadwal);
                    $('#buka_jadwal_edit').val(data.buka_jadwal);
                    $('#tutup_jadwal_edit').val(data.tutup_jadwal);
                })
            });

            $('#saveEditBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                var id = $('#id_edit').val();
                var url = "{{ route('admin.jadwal.update', '') }}" + '/' + id;
                var buka_jadwal = $('#buka_jadwal_edit').val().slice(0, 5);
                var tutup_jadwal = $('#tutup_jadwal_edit').val().slice(0, 5);

                var formData = $('#editJadwalForm').serializeArray();
                formData.push({
                    name: "_method",
                    value: "PUT"
                });
                formData.forEach(function(item) {
                    if (item.name === 'buka_jadwal') {
                        item.value = buka_jadwal;
                    }
                    if (item.name === 'tutup_jadwal') {
                        item.value = tutup_jadwal;
                    }
                });

                $.ajax({
                    url: url,
                    type: "PUT",
                    data: $.param(formData),
                    dataType: 'json',
                    success: function(data) {
                        $('#editJadwalForm').trigger("reset");
                        $('#editJadwalModal').modal('hide');
                        table.draw();
                        $('#saveEditBtn').html('Save Changes');
                        toastr.success(data.success, 'Sukses!');
                    },
                    error: function(data) {
                        var errors = data.responseJSON.errors;
                        $('#editJadwalForm .text-danger').html('');
                        $.each(errors, function(key, value) {
                            $('#' + key + '_edit_error').html(value[0]);
                        });
                        $('#saveEditBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.delete', function() {
                var id = $(this).data("id");
                var url = "{{ route('admin.jadwal.destroy', '') }}" + '/' + id;

                $('#deleteJadwalForm').attr('action', url);
                $('#deleteJadwalModal').modal('show');
            });

            $('#deleteJadwalForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(res) {
                        if (res.status === 200) {
                            table.draw();
                            $('#deleteJadwalModal').modal('hide');
                            toastr.success('Jadwal deleted successfully!', 'Sukses!');
                        } else {
                            toastr.error('Failed to delete data!', 'Error!');
                        }
                    },
                    error: function(data) {
                        toastr.error('Terjadi kesalahan, silakan coba lagi.', 'Error!');
                    }
                });
            });

            $('#deleteJadwalModal').on('hidden.bs.modal', function() {
                $('#deleteJadwalForm').trigger('reset');
            });
            $('#deleteJadwalModal').on('click', '[data-dismiss="modal"]', function() {
                $('#deleteJadwalModal').modal('hide');
            });

            $('#deleteAllJadwalModal').on('show.bs.modal', function(event) {
                $('#deleteAllJadwalForm').attr('action', '{{ route('admin.jadwal.deleteAll') }}');
            });

            $('#deleteAllJadwalForm').submit(function(e) {
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
                            $('#deleteAllJadwalModal').modal('hide');
                            toastr.success('All Jadwal deleted successfully!', 'Sukses!');
                        } else {
                            toastr.error(res.message, 'Error!');
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
