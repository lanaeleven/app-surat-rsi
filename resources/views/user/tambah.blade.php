
@extends('layouts.main')

@section('container')
    
<div>
    
  <div class="d-flex justify-content-between align-items-center my-4">
    <div>
    </div>
    <div>
      <h3 class="fw-bold fs-4 text-center" style="margin-left: 90px;">Tambah User</h3>
    </div>
    <div>
      <a href="/user/index" class="btn btn-warning">Kembali</a>
    </div>
  </div>

    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/user/tambah">
              @csrf

                <div class="row mb-3">
                    <label for="namaJabatan" class="col-sm-3 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-9">
                      <input name="namaJabatan" type="text" class="form-control @error('namaJabatan') is-invalid @enderror" id="namaJabatan" value="{{ old('namaJabatan') }}" required>
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
                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" required>
                    @error('username')
                      <div id="username" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                  </div>
               </div>

               <div class="row mb-3">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                  @error('password')
                    <div id="password" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                    <div class="mb-3 mt-2 form-check">
                      <input type="checkbox" class="form-check-input" id="passwordToggle" onclick="myFunction()">
                      <label class="form-check-label" for="passwordToggle" >Show Password</label>
                    </div>
                </div>
             </div>

                <div class="d-flex justify-content-center">
                  <div>
                    <button type="submit" class="btn btn-success mt-3">Tambah</button>
                  </div>
                </div>
                  
              </form>
        </div>
    </div>
</div>

<script>
  function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>

@endsection