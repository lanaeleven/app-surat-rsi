{{-- @dd($belumDiteruskan) --}}
@extends('layouts.main')
@section('container')

      <div class="mb-3">

        @can('admin')
            
        {{-- DASHBOARD ADMIN --}}

        <h3 class="fw-bold fs-4 mb-3">Dashboard Admin</h3>

        <div class="col">

        
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">{{ $suratMasukHariIni }} Surat</h2>
                  <p class="card-text fs-3">Surat Masuk hari ini</p>
                  <a href="/surat-masuk/hari-ini" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
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
                  <a href="/surat-masuk/bulan-ini" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
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
    {{-- END DASHBOARD ADMIN --}}
    @endcan

    @can('direktur')
    {{-- DASHBOARD DIREKTUR --}}

    <div class="col">
      <h3 class="fw-bold fs-4 mb-3">Dashboard Direktur</h3>
      <div class="row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $belumDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang belum diteruskan</p>
                <a href="/surat-masuk/d/belum-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $sudahDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang sudah diteruskan</p>
                <a href="/surat-masuk/d/sudah-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
      </div>
    </div>
        
    {{-- END DASHBOARD DIREKTUR --}}
    @endcan

    @can('kepala')
    {{-- DASHBOARD KEPALA BAGIAN --}}

    <div class="col">
      <h3 class="fw-bold fs-4 mb-3">Dashboard Kepala Bagian</h3>
      <div class="row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $belumDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang belum diteruskan</p>
                <a href="/surat-masuk/kb/belum-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $sudahDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang sudah diteruskan</p>
                <a href="/surat-masuk/kb/sudah-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
      </div>
    </div>
        
    {{-- END DASHBOARD KEPALA BAGIAN --}}
    @endcan

    @can('penjab')
    {{-- DASHBOARD PENANGGUNG JAWAB --}}

    <div class="col">
      <h3 class="fw-bold fs-4 mb-3">Dashboard Penanggung Jawab</h3>
      <div class="row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $belumDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang belum diteruskan</p>
                <a href="/surat-masuk/pj/belum-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title fw-bold">{{ $sudahDiteruskan }} Surat</h2>
                <p class="card-text fs-3">Surat Masuk yang sudah diteruskan</p>
                <a href="/surat-masuk/pj/sudah-diteruskan" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
      </div>
    </div>
        
    {{-- END DASHBOARD PENANGGUNG JAWAB --}}
    @endcan
        
      </div>
@endsection