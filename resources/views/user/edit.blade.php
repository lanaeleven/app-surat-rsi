
@extends('layouts.main')

@section('container')
    
<div>

  <div class="d-flex justify-content-between align-items-center my-4">
    <div>
      <a href="/user/index" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left" style="color: #000;"></i></a>
    </div>
    <div>
      <h3 class="fw-bold fs-4 text-center">Edit Akun Tujuan Disposisi</h3>
    </div>
    <div>
    </div>
  </div>

      <div class="row justify-content-center">
        <div class="card col-8 mb-5">
          <div class="card-body">
            <h6 class="card-title text-center mb-3">INFORMASI PROFIL</h6>
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

                 <div class="row mb-3">
                  <label for="passwordKonfirmasi" class="col-sm-3 col-form-label"></label>
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-success mt-3">Simpan</button>
                  </div>
              </div>
                  
              </form>
          </div>
          </div>
      </div>

      <div class="row justify-content-center">
        <div class="card col-8 mb-5">
          <div class="card-body">
            <h6 class="card-title text-center mb-3">UBAH PASSWORD</h6>
            <form method="post" action="/user/updatePassword">
              @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
  
                  <div class="row mb-3">
                      <label for="passwordBaru" class="col-sm-3 col-form-label ">Password Baru</label>
                      <div class="col-sm-9">
                        <input name="passwordBaru" type="password" class="form-control @error('passwordBaru') is-invalid @enderror" id="passwordBaru" required>
                        @error('passwordBaru')
                        <div id="passwordBaru" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                        <div class="form-check mt-3">
                          <input type="checkbox" class="form-check-input" id="passwordToggle" onclick="myFunction()">
                          <label class="form-check-label" for="passwordToggle" >Show Password</label>
                        </div>
                      </div>
                  </div>
  
  
              <div class="row mb-3">
                <label for="passwordKonfirmasi" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                  <button type="submit" id="btnUbahPassword" class="btn btn-warning mt-3">Ubah Password</button>
                </div>
            </div>
                  
          </form>
          </div>
          </div>
      </div>
</div>

<script>
  function myFunction() {
    var x = document.getElementById("passwordBaru");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>

@endsection