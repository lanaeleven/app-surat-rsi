{{-- @dd(Storage::url($suratKeluar[0]->filePath)) --}}
@extends('layouts.main')

@section('container')
<div class="div">
    <h3 class="fw-bold fs-4 mb-3">Surat Keluar</h3>
    <div class="d-flex flex-row-reverse my-2">
      <div>
        <a href="/surat-keluar/tambah" class="btn btn-primary">Tambah Data</a>
      </div>
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
                <td>{{ $sk->keterangan }}</td>
                <td>{{ $sk->jenisSurat->kodeJenisSurat . '-' . $sk->jenisSurat->keterangan }}</td>
                <td>
                  <a href="/surat-keluar/edit/{{ $sk->id }}">Edit</a>
                    <a href="{{ asset('storage/' . $sk->filePath) }}" class="mt-1 btn btn-success" target="_blank">view</a>
                    <a href="{{ asset('storage/' . $sk->filePath) }}" class="mt-1 btn btn-primary" download='{{ $sk->fileName }}'>download</a>
                </td>
              </tr>

              @endforeach
              
            </tbody>
          </table>
    </div>

</div>
@endsection