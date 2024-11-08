@extends('layouts.pengguna')

@section('title')
    Promo
@endsection

@section('css')
@endsection

@section('nav')
    <div class="container">
        <a class="navbar-brand" href="promo">
            <img src="{{ asset('image/logo.png') }}" alt="YUPITA Air Minum" style="height: 40px; width: auto;">
        </a>
        <div class="d-flex gap-2">
            <a class="btn btn-light mx-2" href="{{ route('index') }}">
                <i class="fa-solid fa-house"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div  id="promo" class="container my-5 mt-5 text-center">
        <div class="row justify-content-center" style="margin-top: 80px;">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{ asset('image/promo.png') }}" class="card-img-top" alt="logo">
                    <div class="card-body">

                        <div class="container mt-5">
                            <div class="card-body">
                                <h5 class="text-danger">Perhatian!!</h5>
                                <p class="text-danger">Promo bisa berganti sesuai selesainya jadwal promo yang sedang
                                    berlangsung!</p>
                                <div class="card px-2 py-2">
                                    <div class="table-responsive">
                                        <table class="table-striped table-bordered data-table table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Mulai</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>Type Promo</th>
                                                    <th>Info Promo</th>
                                                    <th>Harga Promo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="container mt-3">
                                <div class="d-flex justify-content-center gap-10">
                                    <a href="{{ route('index') }}" class="btn btn-primary mx-5">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                ajax: "{{ route('promo') }}",
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
                ]
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
                       // Function to fetch data without reload
            function fetchPromo() {
                table.ajax.reload(null, false); // user paging is not reset on reload
            }

            // Set interval to fetch data every 1 seconds
            setInterval(fetchPromo, 1000);
        });
    </script>
@endsection
