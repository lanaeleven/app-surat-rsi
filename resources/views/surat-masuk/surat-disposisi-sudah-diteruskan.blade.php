@extends('layouts.main')

@section('container')
<div class="div">

    <div class="d-flex justify-content-between align-itemsz-center my-2">
      <div>
        <a href="/" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left" style="color: #000;"></i></a>
      </div>
      <div>
        <h3 class="fw-bold fs-4 text-center">Surat Masuk yang Sudah Diteruskan</h3>
      </div>
      <div class="d-none d-md-block">
      </div>
    </div>

    @if ($suratMasuk->isEmpty())

        <p class="text-center fs-6 my-5">Anda Tidak Memiliki Surat Masuk yang Sudah Diteruskan</p>

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
                    <a href="/surat-masuk/lacak-distribusi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-info"><i class="fa-solid fa-shoe-prints fa-rotate-270" style="color: #000000;"></i></a>
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
            <td>Indeks</td>
            <td>{{ $sm->index }}</td>
          </tr>
          <tr>
            <td>Direktorat</td>
            <td>{{ $sm->direksi->namaDireksi }}</td>
          </tr>
          <tr>
            <td>Dari</td>
            <td>{{ $sm->pengirim }}</td>
          </tr>
          <tr>
            <td>Tgl Surat</td>
            <td>{{ $sm->tanggalSurat }}</td>
          </tr>
          <tr>
            <td>No Surat</td>
            <td>{{ $sm->nomorSurat }}</td>
          </tr>
          <tr>
            <td>Perihal</td>
            <td>{{ $sm->perihal }}</td>
          </tr>
          <tr>
            <td>Status</td>
            <td>{{ $sm->status }}</td>
          </tr>
          <tr>
            <td colspan="2" class="text-center"><a href="/surat-masuk/lacak-distribusi/{{ $sm->id }}" class="mt-1 btn btn-sm btn-primary">Lacak Distribusi</a></td>
          </tr>
        </table>
      </div>
    </div>        
    @endforeach
    <div class="d-flex justify-content-center">
      <div>
        {{ $suratMasuk->appends(request()->input())->links() }}
      </div>
    </div>
    
    @endif

</div>
@endsection