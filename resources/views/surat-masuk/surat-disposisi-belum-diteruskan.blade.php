@extends('layouts.main')
@section('container')
<div class="div">

    <div class="d-flex justify-content-between align-items-center my-2">
      <div>
        <a href="/" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left" style="color: #000;"></i></a>
      </div>
      <div>
        <h3 class="fw-bold fs-4 text-center">Surat Masuk yang Belum Diteruskan</h3>
      </div>
      <div>
      </div>
    </div>

    {{-- BEGINNING OF PENCARIAN --}}

    <div class="mb-3">
      <form class="row g-3" action="/surat-masuk/ns/belum-diteruskan">
        <div class="row g-3">
          <div class="col-auto">
            <label for="tanggalAwal" class="col-form-label"><small>Tanggal Awal :</small></label>
          </div>
          <div class="col-auto me-3">
              <input name="tanggalAwal" type="date" id="tanggalAwal" class="form-control form-control-sm" value="{{ request('tanggalAwal') }}">
          </div> 
          <div class="col-auto">
              <label for="tanggalAkhir" class="col-form-label"><small>Tanggal Akhir :</small></label>
            </div>
          <div class="col-auto">
              <input name="tanggalAkhir" type="date" id="tanggalAkhir" class="form-control form-control-sm" value="{{ request('tanggalAkhir') }}">
          </div>
        </div>

        <div class="row g-3">
          <div class="col-auto">
            <input name="index" type="number" class="form-control form-control-sm" placeholder="Index" value="{{ request('index') }}">
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
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
          </div>
        </div>
      </form>
    </div>

    {{-- END OF PENCARIAN --}}

    @if ($suratMasuk->isEmpty())

        <p class="text-center fs-6 my-5">Anda Tidak Memiliki Surat Masuk yang Belum Diteruskan</p>

    @else

    <div class="d-none d-md-block">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Indeks</th>
                <th scope="col">Direktorat</th>
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
                <th scope="row">{{ $sm->index }}</th>
                <td>{{ $sm->direksi->namaDireksi }}</td>
                <td>{{ $sm->pengirim }}</td>
                <td>{{ $sm->tanggalSurat }}</td>
                <td>{{ $sm->nomorSurat }}</td>
                <td>{{ $sm->perihal }}</td>
                <td> {{ $sm->status }} </td>
                <td>
                    <a href="/surat-masuk/disposisi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-warning"><i class="fa-solid fa-share" style="color: #000000;"></i></a>
                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>
    </div>
    @foreach ($suratMasuk as $sm)
    <div class="col-12 d-md-none d-lg-none d-xl-none d-xxl-none mb-5">
      <div class="card shadow">
        <table class="table table-bordered">
          <tr>
            <th>Indeks</th>
            <td>{{ $sm->index }}</td>
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
            <td colspan="2" class="text-center"><a href="/surat-masuk/disposisi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-warning">Teruskan Surat</a></td>
          </tr>
        </table>
      </div>
    </div>        
    @endforeach
    @endif
</div>
@endsection