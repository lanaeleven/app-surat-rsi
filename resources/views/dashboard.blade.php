{{-- @dd($belumDiteruskan) --}}
@extends('layouts.main')
@section('container')

      <div class="mb-3">

        @can('dashboard-sekre')
            
        {{-- DASHBOARD SEKRETARIAT --}}

        <h3 class="fw-bold fs-4 my-3">Dashboard Sekretariat</h3>

        <div class="col">

        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">{{ $suratMasukHariIni }} Surat</h2>
                  <p class="card-text fs-3">Surat Masuk hari ini</p>
                  <a href="/surat-masuk/s/hari-ini" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">{{ $suratKeluarHariIni }} Surat</h2>
                  <p class="card-text fs-3">Surat Keluar hari ini</p>
                  <a href="/surat-keluar/hari-ini" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">{{ $suratMasukBulanIni }} Surat</h2>
                  <p class="card-text fs-3">Surat Masuk bulan ini</p>
                  <a href="/surat-masuk/s/bulan-ini" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">{{ $suratKeluarBulanIni }} Surat</h2>
                  <p class="card-text fs-3">Surat Keluar bulan ini</p>
                  <a href="/surat-keluar/bulan-ini" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
        </div>

    </div>
    {{-- END DASHBOARD SEKRETARIAT --}}
    @endcan

    @can('dashboard-not-sekre')
    {{-- DASHBOARD NON SEKRETARIAT --}}

    <div class="col">
      <h3 class="fw-bold fs-4 mb-3">Dashboard {{ auth()->user()->namaJabatan }}</h3>
      <div class="row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $belumDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang belum diteruskan</p>
                <a href="/surat-masuk/ns/belum-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $sudahDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang sudah diteruskan</p>
                <a href="/surat-masuk/ns/sudah-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
      </div>
    </div>
        
    {{-- END DASHBOARD NON SEKRETARIAT --}}
    @endcan        
      </div>
@endsection