@extends('layouts.pengguna')

@section('title')
    Kontak
@endsection

@section('css')
    <style>
        .promo-container {
            margin-top: 100px;
        }

        .promo-card {
            margin-bottom: 20px;
        }

        .promo-image {
            max-height: 300px;
            object-fit: cover;
        }

        .whatsapp-link {
            display: inline-block;
            background-color: #25d366;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .whatsapp-link:hover {
            background-color: #128c7e;
        }
    </style>
@endsection

@section('nav')
    <div class="container">
        <a class="navbar-brand" href="kontak">
            <img src="{{ asset('image/logo.png') }}" alt="YUPITA Air Minum" style="height: 40px; width: auto;">
        </a>
        <div class="d-flex gap-2">
            <a class="btn btn-light mx-2" href="{{ url('/') }}">
                <i class="fa-solid fa-house"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div  id="kontak" class="promo-container container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card promo-card">
                    <img src="{{ asset('image/kontak.png') }}" class="card-img-top promo-image" alt="promo">
                    <div class="card-body">
                        <h2 class="text-center">Hubungi Kami</h2>
                        <p class="text-center">Klik link WhatsApp di bawah ini untuk menghubungi kami:</p>
                        <div class="text-center">
                            <a href="https://wa.me/62817394484" class="whatsapp-link">
                                Hubungi via WhatsApp <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <a href="{{ url('/') }}" class="btn btn-primary mx-5">
                            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
