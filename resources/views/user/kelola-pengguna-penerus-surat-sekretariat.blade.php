@extends('layouts.main')

@section('container')

<div>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif  

  @php

  $noListPenerus = 1;
  $noPenerima = 1;

  @endphp

  <div class="d-flex justify-content-between align-items-center my-4">
    <div>
      <h3 class="fw-bold fs-4 text-center">Kelola Pengguna Penerus Surat Sekretariat</h3>
    </div>
    <div>
    </div>
  </div>

  <div class="row justify-content-around">

      <div class="col-5 justify-content-center">
        <div class="card mb-5">
          <div class="card-body">

            <h5 class="text-center">Daftar Pengguna Penerus Surat Sekretariat</h5>
            <div class="d-flex justify-content-end">
                <div>
                    <button class="btn btn-success btn-sm mx-auto" data-bs-toggle="modal" data-bs-target="#tambahPenggunaPenerusSuratSekretariat">Tambah Pengguna</button>
                </div>
            </div>

            <table class="table table-striped d-none d-md-table d-lg-table d-xl-table d-xxl-table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jabatan Pengirim</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($listUserPenerus as $penerus)
                        
                    <tr>
                        <td>{{ $noListPenerus++ }}</td>
                        <td>{{ $penerus->namaJabatan }}</td>
                        <td>
                            <a href="/hapus-pengguna-penerus-surat-sekretariat/{{ $penerus->id }}" class="mt-1 btn btn-sm btn-danger"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
              </table>            
    
          </div>
        </div>
      </div>

  </div>

  {{-- modal tambah pengguna penerus surat sekretariat --}}
  <div class="modal fade" id="tambahPenggunaPenerusSuratSekretariat" data-bs-backdrop="static" tabindex="-1" aria-labelledby="tambahPenggunaPenerusSuratSekretariatLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahPenggunaPenerusSuratSekretariatLabel">Tambah Pengguna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form method="POST" id="formtambahPenggunaPenerusSuratSekretariat" action="/user/tambah-pengguna-penerus-surat-sekretariat">
            @csrf

              <div class="col-auto">
                <label for="awal" class="col-form-label"><small>Jabatan Pengguna</small></label>
              </div>
              <div class="col-auto mb-3">
                <select name="idUser" class="form-select" id="idUser" required>
                    <option value="">Pilih Pengguna</option>

                    @foreach ($listUserBukanPenerus as $bukanPenerus)
                  
                    <option value="{{ $bukanPenerus->id }}">{{ $bukanPenerus->namaJabatan }}</option>

                    @endforeach

                </select>
              </div> 
              <button type="submit" class="btn btn-success container-fluid">Tambah</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  {{-- end of modal tambah pengguna penerus surat sekretariat --}}




</div>

@endsection