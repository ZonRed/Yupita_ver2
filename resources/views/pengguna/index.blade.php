@extends('layouts.pengguna')

@section('title')
    Aquavita
@endsection

@section('css')
    <style>
        .card {
            max-height: 100%;
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@endsection

@section('nav')
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('image/logo.png') }}" alt="YUPITA Air Minum" style="height: 40px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#informasi-penjualan">Informasi Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#lokasi-map">Lokasi Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#laporan">Laporan</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <section id="beranda" class="py-5" style="margin-top: 80px;">
        <div class="container text-center">
            <div class="col text-center">
                <h3>Beranda</h3>
                <h1>~Selamat datang di "YUPITA AIR MINUM"~</h1>
                <p>
                    "YUPITA AIR MINUM - tempat terpercaya untuk mendapatkan minuman berkualitas dan es batu yang segar
                    sepanjang hari!"
                </p>
            </div>
        </div>
    </section>

    <section id="informasi-penjualan" class="bg-light py-5">
        <div class="container">
            <div class="col mb-4 text-center">
                <h3>Informasi Penjualan</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/jadwal_operasional.png') }}"
                            style="max-width: 100%; height: auto; object-fit: cover;" class="card-img-top" alt="Berita 1">

                        <div class="card-body">
                            <h3 class="card-title">Jadwal Operasional</h3>
                            <p class="card-text">Berisi : Jadwal Operasional Toko Yupita Air Minum</p>
                            <a href="{{ route('jadwal') }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/produk_penjualan.png') }}"
                            style="max-width: 100%; height: auto; object-fit: cover;" class="card-img-top" alt="Berita 2">

                        <div class="card-body">
                            <h3 class="card-title">Produk Penjualan</h3>
                            <p class="card-text">Berisi : type, ukuran, harga, dan stock</p>
                            <a href="{{ route('jual') }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/promo.png') }}" style="max-width: 100%; height: auto; object-fit: cover;"
                            class="card-img-top" alt="Berita 3">
                        <div class="card-body">
                            <h3 class="card-title">Promo</h3>
                            <p class="card-text">Berisi : Promo Yang sedang berlangsung</p>
                            <a href="{{ route('promo') }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/kontak.png') }}" style="max-width: 100%; height: auto; object-fit: cover;"
                            class="card-img-top" alt="Berita 4">
                        <div class="card-body">
                            <h3 class="card-title">Kontak</h3>
                            <p class="card-text">Berisi : nomer WA, untuk pemesanan</p>
                            <a href="{{ route('kontak') }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="lokasi-map" class="py-5">
        <div class="container">
            <div class="col text-center">
                <h3>Lokasi Yupita Air Minum</h3>
                <p>
                    Tempat Lokasi "Yupita Air Minum" , Untuk Petunjuk Lokasi Google Map bisa tekan tombol 'Buka di Google
                    Maps' di bawah map
                </p>
            </div>

            <div id="map"></div>
            <div class="mt-3 text-center">
                <button class="btn btn-primary" id="openGoogleMapsBtn">Buka di Google Maps</button>
            </div>
        </div>
    </section>

    <section id="laporan" class="py-5">
        <div class="container">
            <div class="col text-center">
                <h3>Laporan Yupita Air Minum</h3>
                <p>Jika Anda memiliki pertanyaan atau masukan, jangan ragu untuk input laporan melalui formulir di
                    bawah ini.</p>
            </div>

            <form action="{{ route('laporan', ['section' => 'laporan']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_laporan" class="form-label">Nama
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="nama_laporan" required>
                </div>

                <div class="mb-3">
                    <label for="email_laporan" class="form-label">Email
                        <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control" name="email_laporan" required>
                </div>

                <div class="mb-3">
                    <label for="pesan_laporan" class="form-label">Pesan
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="pesan_laporan" required>
                </div>
                <input type="submit" value="Kirim" class="btn btn-primary">
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function initializeMap() {
            const platform = new H.service.Platform({
                apikey: "v0UpMK3EXITJJAAkMChM_mCOktil9_ddFSpiQRwnhGo"
            });
            const defaultLayers = platform.createDefaultLayers();
            const map = new H.Map(
                document.getElementById("map"),
                defaultLayers.vector.normal.map, {
                    center: {
                        lat: -7.365414986509003,
                        lng: 112.7642935736513
                    },
                    zoom: 15,
                    pixelRatio: window.devicePixelRatio || 1,
                }
            );
            window.addEventListener("resize", () => map.getViewPort().resize());
            const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
            const ui = H.ui.UI.createDefault(map, defaultLayers);

            function addMarkersToMap(map) {
                var fanbasemarker = new H.map.Marker({
                    lat: -7.365628,
                    lng: 112.764320
                });
                map.addObject(fanbasemarker);
            }
            window.onload = function() {
                addMarkersToMap(map);
            }
        }
        initializeMap();

        function openGoogleMaps() {
            const fanbaseLocation = {
                lat: -7.365628,
                lng: 112.764320
            };
            const googleMapsUrl =
                `https://www.google.com/maps/search/?api=1&query=${fanbaseLocation.lat},${fanbaseLocation.lng}`;
            window.open(googleMapsUrl, '_blank');
        }
        document.getElementById('openGoogleMapsBtn').addEventListener('click', openGoogleMaps);

         // Scroll to section if query parameter is present
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const section = urlParams.get('section');
        if (section) {
            const sectionElement = document.getElementById(section);
            if (sectionElement) {
                sectionElement.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
    </script>
@endsection
