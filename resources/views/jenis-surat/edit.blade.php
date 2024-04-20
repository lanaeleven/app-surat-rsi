
@extends('layouts.main')

@section('container')
    
<div>
    <h3 class="fw-bold fs-4 mb-3 text-center">Edit Jenis Surat</h3>
    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/jenis-surat/save">
              @csrf
                <input type="hidden" name="id" value="{{ $jenisSurat->id }}">

                <div class="row mb-3">
                    <label for="kodeJenisSurat" class="col-sm-3 col-form-label">Kode Jenis Surat</label>
                    <div class="col-sm-9">
                      <input name="kodeJenisSurat" type="text" class="form-control @error('kodeJenisSurat') is-invalid @enderror" id="kodeJenisSurat" value="{{ $jenisSurat->kodeJenisSurat }}" required>
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
                    <input name="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" value="{{ $jenisSurat->keterangan }}" required>
                    @error('keterangan')
                    <div id="keterangan" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
              </div>

                <div class="d-flex justify-content-center">
                  <div>
                    <a href="/jenis-surat/index" class="btn btn-warning mt-3 me-4">Kembali</a>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-success mt-3">Simpan</button>
                  </div>
                </div>
                  
              </form>
        </div>
    </div>
</div>

@endsection