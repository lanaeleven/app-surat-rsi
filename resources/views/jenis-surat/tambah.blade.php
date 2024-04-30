
@extends('layouts.main')

@section('container')
    
<div>
    
  <div class="d-flex justify-content-between align-items-center my-4">
    <div>
    </div>
    <div>
      <h3 class="fw-bold fs-4 text-center" style="margin-left: 90px;">Tambah Jenis Surat</h3>
    </div>
    <div>
      <a href="/jenis-surat/index" class="btn btn-warning">Kembali</a>
    </div>
  </div>

    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/jenis-surat/tambah">
              @csrf

                <div class="row mb-3">
                    <label for="kodeJenisSurat" class="col-sm-3 col-form-label">Kode Jenis Surat</label>
                    <div class="col-sm-9">
                      <input name="kodeJenisSurat" type="text" class="form-control @error('kodeJenisSurat') is-invalid @enderror" id="kodeJenisSurat" value="{{ old('kodeJenisSurat') }}" required>
                      @error('kodeJenisSurat')
                      <div id="kodeJenisSurat" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="col-sm-9">
                    <input name="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{ old('keterangan') }}" required>
                    @error('keterangan')
                      <div id="keterangan" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
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

@endsection