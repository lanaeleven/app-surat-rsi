
@extends('layouts.main')

@section('container')
    
<div>
    <h3 class="fw-bold fs-4 mb-3 text-center">Tambah Direksi</h3>
    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/direksi/tambah">
              @csrf

                <div class="row mb-3">
                    <label for="namaDireksi" class="col-sm-3 col-form-label">Nama Direksi</label>
                    <div class="col-sm-9">
                      <input name="namaDireksi" type="text" class="form-control @error('namaDireksi') is-invalid @enderror" id="namaDireksi" value="{{ old('namaDireksi') }}" required>
                      @error('namaDireksi')
                      <div id="namaDireksi" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                  <div>
                    <a href="/direksi/index" class="btn btn-warning mt-3 me-4">Kembali</a>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-success mt-3">Tambah</button>
                  </div>
                </div>
                  
              </form>
        </div>
    </div>
</div>

@endsection