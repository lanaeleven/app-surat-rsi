{{-- @dd($suratMasuk[0]->direksi->namaDireksi) --}}
@extends('layouts.main')

@section('container')
<div>
  @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif  
    <div class="d-flex justify-content-between my-2">
      <div class="mb-2">
      @if (!is_null($keterangan))
      {{-- <a href="/" class="btn btn-warning btn-sm d-none d-md-block d-lg-block d-xl-block d-xxl-block">Kembali</a> --}}
      <a href="/" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left" style="color: #000;"></i></a>
      @endif
      </div>
      <div>
        <h3 class="fw-bold fs-4">{{ $judul }}</h3>
      </div>
      <div class="mb-2">
      @if (is_null($keterangan))
        <a href="/surat-masuk/tambah" class="btn btn-primary d-none d-md-block d-lg-block d-xl-block d-xxl-block">Tambah</a>
        <a href="/surat-masuk/tambah" class="btn btn-primary btn-sm d-md-none d-lg-none d-xl-none d-xxl-none"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></a>
        @endif
      </div>
    </div>

    <div>
      <form class="row g-3" action="/surat-masuk/index">
        @if (is_null($keterangan))
        <div class="row g-3">
          <div class="col-auto">
            <label for="tanggalAwal" class="col-form-label"><small>Tanggal Awal :</small></label>
          </div>
          <div class="col-auto">
              <input name="tanggalAwal" type="date" id="tanggalAwal" class="form-control form-control-sm" value="{{ request('tanggalAwal') }}">
          </div> 
          <div class="col-auto ms-3">
              <label for="tanggalAkhir" class="col-form-label"><small>Tanggal Akhir :</small></label>
            </div>
          <div class="col-auto">
              <input name="tanggalAkhir" type="date" id="tanggalAkhir" class="form-control form-control-sm" value="{{ request('tanggalAkhir') }}">
          </div>
        </div>
        @endif

        <div class="row g-3">
          <div class="col-auto">
            <input name="index" type="number" class="form-control form-control-sm" placeholder="Index" value="{{ request('index') }}">
          </div>
          <div class="col-auto">
            <select name="direksi" class="form-select form-select-sm">
              <option value="">Semua Direksi</option>
              @foreach ($direksi as $d)
              <option value="{{ $d->id }}" {{ request('direksi') == $d->id ? 'selected' : '' }}>{{ $d->namaDireksi }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-auto">
            <input name="pengirim" type="text" class="form-control form-control-sm" placeholder="Pengirim" value="{{ request('pengirim') }}">
          </div>
          <div class="col-auto">
            <input name="nomorSurat" type="text" class="form-control form-control-sm" placeholder="Nomor Surat" value="{{ request('nomorSurat') }}">
          </div>
          <div class="col-auto">
            <input name="perihal" type="text" class="form-control form-control-sm" placeholder="Perihal" value="{{ request('perihal') }}">
          </div>
          
          <div class="col-auto">
            {{-- <button type="submit" class="btn btn-secondary btn-sm mb-3 d-none d-md-block d-lg-block d-xl-block d-xxl-block">Cari</button> --}}
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
          </div>
        </div>
      </form>
    </div>

    <div class="div">
        <table class="table table-striped d-none d-md-table d-lg-table d-xl-table d-xxl-table">
            <thead>
              <tr>
                <th scope="col">Indeks</th>
                <th scope="col">Direktorat</th>
                {{-- <th scope="col">Tgl Agenda</th> --}}
                <th scope="col">Dari</th>
                <th scope="col">Tgl Surat</th>
                <th scope="col">No Surat</th>
                <th scope="col">Perihal</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($suratMasuk as $sm)
                  
              <tr>
                <th scope="row">{{ $sm->id }}</th>
                <td>{{ $sm->direksi->namaDireksi }}</td>
                {{-- <td>{{ $sm->tanggalAgenda }}</td> --}}
                <td>{{ $sm->pengirim }}</td>
                <td>{{ $sm->tanggalSurat }}</td>
                <td>{{ $sm->nomorSurat }}</td>
                <td>{{ $sm->perihal }}</td>
                <td> {{ $sm->status }} </td>
                <td>
                  <a href="/surat-masuk/edit/{{ $sm->id }}" class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a>
                  <a href="/surat-masuk/lacak-distribusi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-secondary"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
                  <a href="/surat-masuk/disposisi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-warning"><i class="fa-solid fa-share" style="color: #000000;"></i></a>
                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>

          {{-- Tampilan Daftar Surat Masuk pada mobile device --}}
          @foreach ($suratMasuk as $sm)
    <div class="col-12 d-md-none d-lg-none d-xl-none d-xxl-none mt-3 mb-5">
      <div class="card shadow">
        <table class="table table-bordered">
          <tr>
            <th>Indeks</th>
            <td>{{ $sm->id }}</td>
          </tr>
          <tr>
            <th>Direktorat</th>
            <td>{{ $sm->direksi->namaDireksi }}</td>
          </tr>
          <tr>
            <th>Dari</th>
            <td>{{ $sm->pengirim }}</td>
          </tr>
          <tr>
            <th>Tgl Surat</th>
            <td>{{ $sm->tanggalSurat }}</td>
          </tr>
          <tr>
            <th>No Surat</th>
            <td>{{ $sm->nomorSurat }}</td>
          </tr>
          <tr>
            <th>Perihal</th>
            <td>{{ $sm->perihal }}</td>
          </tr>
          <tr>
            <th>Status</th>
            <td>{{ $sm->status }}</td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <a href="/surat-masuk/edit/{{ $sm->id }}" class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a>
              <a href="/surat-masuk/lacak-distribusi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-secondary"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
              <a href="/surat-masuk/disposisi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-warning"><i class="fa-solid fa-share" style="color: #000000;"></i></a>
            </td>
          </tr>
        </table>
      </div>
    </div>        
    @endforeach

    </div>
    <div class="d-flex justify-content-center">
      <div>
        {{ $suratMasuk->links() }}
      </div>
    </div>

</div>
@endsection