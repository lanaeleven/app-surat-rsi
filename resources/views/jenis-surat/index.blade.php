
@extends('layouts.main')

@section('container')
<div class="div">
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif  
    <h3 class="fw-bold fs-4 mb-3">Daftar Jenis Surat</h3>

    <div class="d-flex flex-row-reverse my-2">
        <div class="mb-2">
          <a href="/jenis-surat/tambah" class="btn btn-primary">Tambah Jenis Surat</a>
        </div>
      </div>   

    <div class="div">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Kode Jenis Surat</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jenisSurat as $js)
                  <tr>
                    <td>{{ $js->id }}</td>
                    <td>{{ $js->kodeJenisSurat }}</td>
                    <td>{{ $js->keterangan }}</td>
                    <td><a href="/jenis-surat/edit/{{ $js->id }}" class="mt-1 btn btn-sm btn-primary"><i class="lni lni-pencil"></i></a></td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>
    {{-- <div class="d-flex justify-content-center">
      <div>
        {{ $suratMasuk->links() }}
      </div>
    </div> --}}

</div>
@endsection