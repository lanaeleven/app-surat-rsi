{{-- @dd(Storage::url($suratKeluar[0]->filePath)) --}}
@extends('layouts.main')

@section('container')
<div class="div">
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
      </div>
      <div>
        <h3 class="fw-bold fs-4 mb-3">{{ $judul }}</h3>
      </div>
      <div class="mb-2">
      <a href="/spo/tambah" class="btn btn-primary d-none d-md-block d-lg-block d-xl-block d-xxl-block">Tambah</a>
      <a href="/spo/tambah" class="btn btn-primary btn-sm d-md-none d-lg-none d-xl-none d-xxl-none"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></a>
      </div>
    </div>
    <div>
      <form class="row g-3" action="/spo/index">

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
            <input name="tujuan" type="text" class="form-control form-control-sm" placeholder="Tujuan" value="{{ request('tujuan') }}">
          </div>
          <div class="col-auto">
            <input name="perihal" type="text" class="form-control form-control-sm" placeholder="Perihal" value="{{ request('perihal') }}">
          </div>
          <div class="col-auto">
            <input name="keterangan" type="text" class="form-control form-control-sm" placeholder="Keterangan" value="{{ request('keterangan') }}">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
          </div>
        </div>
      </form>
    </div>
    
    <div>
        <table class="table table-striped  d-none d-md-table d-lg-table d-xl-table d-xxl-table">
            <thead>
              <tr>
                <th scope="col">Indeks</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Tujuan</th>
                <th scope="col">Perihal</th>
                <th scope="col">Direktorat</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($spo as $s)
                  
              <tr>
                <th scope="row">{{ $s->id }}</th>
                <td>{{ $s->tanggalSurat }}</td>
                <td>{{ $s->tujuan }}</td>
                <td>{{ $s->perihal }}</td>
                <td>{{ $s->direksi->namaDireksi }}</td>
                @php
                    $arr = explode(' ', $s->keterangan);
                    
                @endphp
                <td>
                  @if (count($arr) > 2)
                  {{ $arr[0] . ' ' . $arr[1] . '...' }}
                  @else
                  {{ $s->keterangan }}
                  @endif
                </td>
                <td>
                  
                  <a href="/spo/edit/{{ $s->id }}" class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a>
                  <a href="{{ asset('storage/' . $s->filePath) }}" class="mt-1 btn btn-sm btn-secondary" target="_blank"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
                  <a href="{{ asset('storage/' . $s->filePath) }}" class="mt-1 btn btn-sm btn-success" download='{{ $s->fileName }}'><i class="fa-solid fa-download" style="color: #ffffff;"></i></a>
                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>

          {{-- Tampilan Daftar Surat Masuk pada mobile device --}}
          @foreach ($spo as $s)
    <div class="col-12 d-md-none d-lg-none d-xl-none d-xxl-none mt-3 mb-5">
      <div class="card shadow">
        <table class="table table-bordered">
          <tr>
            <th>Indeks</th>
            <td>{{ $s->id }}</td>
          </tr>
          <tr>
            <th>Tanggal</th>
            <td>{{ $s->tanggalSurat }}</td>
          </tr>
          <tr>
            <th>Tujuan</th>
            <td>{{ $s->tujuan }}</td>
          </tr>
          <tr>
            <th>Perihal</th>
            <td>{{ $s->perihal }}</td>
          </tr>
          <tr>
            <th>Direktorat</th>
            <td>{{ $s->direksi->namaDireksi }}</td>
          </tr>
          <tr>
            <th>Keterangan</th>
            <td>{{ $s->keterangan }}</td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <a href="/spo/edit/{{ $s->id }}" class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a>
              <a href="{{ asset('storage/' . $s->filePath) }}" class="mt-1 btn btn-sm btn-success" download='{{ $s->fileName }}'><i class="fa-solid fa-download" style="color: #ffffff;"></i></a>
            </td>
          </tr>
        </table>
      </div>
    </div>        
    @endforeach

        </div>

        <div class="d-flex justify-content-center">
          <div>
            {{ $spo->links() }}
          </div>
        </div>

</div>
@endsection