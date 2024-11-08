@extends('layouts.pengguna')

@section('title')
    Produk
@endsection

@section('css')
@endsection

@section('nav')
    <div class="container">
        <a class="navbar-brand" href="jual">
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
    <div  id="jual" class="container my-5 mt-5 text-center">
        <div class="row justify-content-center" style="margin-top: 80px;">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{ asset('image/produk_penjualan.png') }}" class="card-img-top" alt="logo">
                    <div class="card-body">
                        <div class="container mt-5">
                            <div class="card-body">
                                <h5 class="text-danger">Perhatian!!</h5>
                                <p class="text-danger">Harga barang dan Stock bisa berganti sewaktu - waktu!</p>
                                <div class="card px-2 py-2">
                                    <div class="table-responsive">
                                        <table class="table-striped table-bordered data-table table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Jual</th>
                                                    <th>Type Jual</th>
                                                    <th>Harga Jual</th>
                                                    <th>Stock Jual</th>
                                                    <th>Jumlah Jual</th>
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
                ajax: "{{ route('jual') }}",
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
            function fetchJual() {
                table.ajax.reload(null, false); // user paging is not reset on reload
            }

            // Set interval to fetch data every 1 seconds
            setInterval(fetchJual, 1000);
        });
    </script>
@endsection
