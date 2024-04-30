
@extends('layouts.main')

@section('container')
    
<div>
    
  <div class="d-flex justify-content-between align-items-center my-4">
    <div>
    </div>
    <div>
      <h3 class="fw-bold fs-4 text-center" style="margin-left: 90px;">Edit User</h3>
    </div>
    <div>
      <a href="/user/index" class="btn btn-warning">Kembali</a>
    </div>
  </div>

    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/user/save">
              @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
  
                  <div class="row mb-3">
                      <label for="namaJabatan" class="col-sm-3 col-form-label">Nama Jabatan</label>
                      <div class="col-sm-9">
                        <input name="namaJabatan" type="text" class="form-control @error('namaJabatan') is-invalid @enderror" id="namaJabatan" value="{{ $user->namaJabatan }}" required>
                        @error('namaJabatan')
                        <div id="namaJabatan" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                  </div>
  
                  <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                      <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ $user->username }}" required>
                      @error('username')
                        <div id="username" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                 </div>

                <div class="d-flex justify-content-center">
                  <div>
                    <button type="submit" class="btn btn-success mt-3">Simpan</button>
                  </div>
                </div>
                  
              </form>
        </div>
    </div>
</div>

@endsection