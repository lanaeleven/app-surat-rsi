{{-- @dd(Storage::url($suratKeluar[0]->filePath)) --}}
@extends('layouts.main')

@section('container')
<div class="div">
    <h3 class="fw-bold fs-4 mb-3">Surat Keluar</h3>
    <div class="d-flex flex-row-reverse my-2">
      <div class="mb-2">
        <a href="/surat-keluar/tambah" class="btn btn-primary">Tambah</a>
      </div>
    </div>
    <div>
      <form class="row g-3" action="/surat-keluar/index">
        <div class="col-auto">
          <input name="index" type="number" class="form-control" placeholder="Index" value="{{ request('index') }}">
        </div>
        <div class="col-auto">
          <input name="tahun" type="number" class="form-control" placeholder="Tahun" value="{{ request('tahun') }}">
        </div>
        <div class="col-auto">
          <select name="jenisSurat" class="form-select" value="{{ request('jenisSurat') }}">
            <option value="">Semua Jenis Surat</option>
            @foreach ($jenisSurat as $js)
              <option value="{{ $js->id }}" {{ request('jenisSurat') == $js->id ? 'selected' : '' }}>{{ $js->kodeJenisSurat.'-'.$js->keterangan }}</option>
              @endforeach
          </select>
        </div>
        <div class="col-auto">
          <select name="direksi" class="form-select">
            <option value="">Semua Direksi</option>
            @foreach ($direksi as $d)
            <option value="{{ $d->id }}" {{ request('direksi') == $d->id ? 'selected' : '' }}>{{ $d->namaDireksi }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-auto">
          <input name="tujuan" type="text" class="form-control" placeholder="Tujuan" value="{{ request('tujuan') }}">
        </div>
        <div class="col-auto">
          <input name="perihal" type="text" class="form-control" placeholder="Perihal" value="{{ request('perihal') }}">
        </div>
        <div class="col-auto">
          <input name="keterangan" type="text" class="form-control" placeholder="Keterangan" value="{{ request('keterangan') }}">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-secondary mb-3">Cari</button>
        </div>
      </form>
    </div>
    <div class="div">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
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
              
              @foreach ($suratKeluar as $sk)
                  
              <tr>
                <th scope="row">{{ $sk->id }}</th>
                <td>{{ $sk->tanggalSurat }}</td>
                <td>{{ $sk->tujuan }}</td>
                <td>{{ $sk->perihal }}</td>
                <td>{{ $sk->direksi->namaDireksi }}</td>
                @php
                    $arr = explode(' ', $sk->keterangan);
                    
                @endphp
                <td>
                  @if (count($arr) > 2)
                  {{ $arr[0] . ' ' . $arr[1] . '...' }}
                  @else
                  {{ $sk->keterangan }}
                  @endif
                </td>
                <td>{{ $sk->jenisSurat->keterangan }}</td>
                <td>
                  
                  <a href="/surat-keluar/edit/{{ $sk->id }}" class="mt-1 btn btn-sm btn-primary"><i class="lni lni-pencil"></i></a>
                    <a href="{{ asset('storage/' . $sk->filePath) }}" class="mt-1 btn btn-sm btn-warning" target="_blank"><i class="lni lni-eye"></i></a>
                    <a href="{{ asset('storage/' . $sk->filePath) }}" class="mt-1 btn btn-sm btn-success" download='{{ $sk->fileName }}'><i class="lni lni-download"></i></a>
                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>

        </div>

        <div class="d-flex justify-content-center">
          <div>
            {{ $suratKeluar->links() }}
          </div>
        </div>

</div>
@endsection