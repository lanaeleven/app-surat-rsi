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
      <div></div>
      <div>
        <h3 class="fw-bold fs-4 mb-3">{{ $judul }}</h3>
      </div>
      <div class="mb-2">
        <a href="/regulasi/tambah" class="btn btn-primary d-none d-md-block d-lg-block d-xl-block d-xxl-block">Tambah</a>
        <a href="/regulasi/tambah" class="btn btn-primary btn-sm d-md-none d-lg-none d-xl-none d-xxl-none"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></a>
      </div>
    </div>

    <div class="d-flex justify-content-end">
      <div>
        <button class="btn btn-success btn-sm py-2 fs-6 mx-auto" data-bs-toggle="modal" data-bs-target="#unduhRekapModal">Unduh Rekap</button>
      </div>
    </div>

    {{-- Modal Unduh Rekap --}}
    <div class="modal fade" id="unduhRekapModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="unduhRekapModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="unduhRekapModalLabel">Rekap File Regulasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form method="POST" action="/unduh-rekap-regulasi">
              @csrf
              {{-- <div class="mb-3">
                <label for="bulanRekap" class="col-form-label">Pilih Bulan</label>
                <input type="month" id="bulanRekap" name="bulanRekap"  class="form-control" required>
              </div> --}}
              <div class="col-auto">
                <label for="awal" class="col-form-label"><small>Awal</small></label>
              </div>
              <div class="col-auto mb-3">
                <input name="awal" type="date" id="awal" class="form-control form-control-sm">
              </div>
              <div class="col-auto">
                <label for="akhir" class="col-form-label"><small>Akhir</small></label>
              </div>
              <div class="col-auto mb-3">
                <input name="akhir" type="date" id="akhir" class="form-control form-control-sm">
              </div>
              <button type="submit" class="btn btn-success container-fluid">Unduh Rekap</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    {{-- end of modal --}}

    <div>
      <form class="row g-3" action="">
        <div class="row g-3">
          <div class="col-auto">
            <input name="tahun" type="number" class="form-control form-control-sm" placeholder="Tahun" value="{{ request('tahun') }}">
          </div>
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
            <select name="jenisRegulasi" class="form-select form-select-sm" value="{{ request('jenisRegulasi') }}">
              <option value="">Semua Jenis Regulasi</option>
              @foreach ($jenisRegulasi as $js)
              <option value="{{ $js->id }}" {{ request('jenisRegulasi') == $js->id ? 'selected' : '' }}>{{ $js->kodeJenisRegulasi.'-'.$js->keterangan }}</option>
              @endforeach
            </select>
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

    @if ($regulasi->isEmpty())

    <p class="text-center fs-6 my-5">Anda Tidak Memiliki {{ $judul }}</p>

    @else

    <div>
      <table class="table table-striped table-bordered d-none d-md-table d-lg-table d-xl-table d-xxl-table mt-2">
        <thead>
          <tr>
            <th scope="col">Indeks</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Tujuan</th>
            <th scope="col">Perihal</th>
            <th scope="col">Direktorat</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jenis</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($regulasi as $r)

          <tr>
            <th scope="row">{{ $r->index }}</th>
            <td>{{ $r->tanggalSurat }}</td>
            <td>{{ $r->tujuan }}</td>
            <td>{{ $r->perihal }}</td>
            <td>{{ $r->direksi->namaDireksi }}</td>
            @php
            $arr = explode(' ', $r->keterangan);

            @endphp
            <td>
              @if (count($arr) > 2)
              {{ $arr[0] . ' ' . $arr[1] . '...' }}
              @else
              {{ $r->keterangan }}
              @endif
            </td>
            <td>{{ $r->jenisRegulasi->keterangan }}</td>
            <td>

              <a href="/regulasi/edit/{{ $r->id }}" class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a>
              <a href="{{ asset('storage/' . $r->filePath) }}" class="mt-1 btn btn-sm btn-secondary" target="_blank"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
            </td>
          </tr>

          @endforeach

        </tbody>
      </table>

      {{-- Tampilan Daftar Surat Keluar pada mobile device --}}
      @foreach ($regulasi as $r)
      <div class="col-12 d-md-none d-lg-none d-xl-none d-xxl-none mt-3 mb-5">
        <div class="card shadow">
          <table class="table table-bordered">
            <tr>
              <th>Indeks</th>
              <td>{{ $r->index }}</td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td>{{ $r->tanggalSurat }}</td>
            </tr>
            <tr>
              <th>Tujuan</th>
              <td>{{ $r->tujuan }}</td>
            </tr>
            <tr>
              <th>Perihal</th>
              <td>{{ $r->perihal }}</td>
            </tr>
            <tr>
              <th>Direktorat</th>
              <td>{{ $r->direksi->namaDireksi }}</td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td>{{ $r->keterangan }}</td>
            </tr>
            <tr>
              <th>Jenis</th>
              <td>{{ $r->jenisRegulasi->keterangan }}</td>
            </tr>
            <tr>
              <td colspan="2" class="text-center">
                <a href="/regulasi/edit/{{ $r->id }}" class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil" style="color: #ffffff;"></i></a>
                <a href="{{ asset('storage/' . $r->filePath) }}" class="mt-1 btn btn-sm btn-success" download='{{ $r->fileName }}'><i class="fa-solid fa-download" style="color: #ffffff;"></i></a>
              </td>
            </tr>
          </table>
        </div>
      </div>
      @endforeach

    </div>

    <div class="d-flex justify-content-center">
      <div>
        {{ $regulasi->appends(request()->input())->links() }}
      </div>
    </div>
    @endif
  </div>
  @endsection