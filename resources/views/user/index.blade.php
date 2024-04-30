
@extends('layouts.main')

@section('container')
<div class="div">
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif  
  <div class="d-flex justify-content-between my-2">
    <div>
      <h3 class="fw-bold fs-4 mb-3">Daftar User</h3>
    </div>
    <div>
      <a href="/user/tambah" class="btn btn-primary">Tambah User</a>
    </div>
  </div>

    <div class="div">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Nama Jabatan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user as $u)
                  <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->namaJabatan }}</td>
                    <td>{{ $u->level }}</td>
                    <td>{{ $u->divisi }}</td>
                    <td><a href="/user/edit/{{ $u->id }}" class="mt-1 btn btn-sm btn-primary"><i class="lni lni-pencil"></i></a></td>
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