{{-- @dd($jenisSurat[0]->kodeJenisSurat.'-'.$jenisSurat[0]->keterangan) --}}
{{-- @dd($direksi) --}}
@extends('layouts.main')

@section('container')

<div>
    <div class="d-flex justify-content-between align-items-center my-4">
      <div>
        <a href="/spo/index" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left" style="color: #000;"></i></a>
      </div>
      <div>
        <h3 class="fw-bold fs-4 text-center">Tambah Surat Prosedur Operasional</h3>
      </div>
      <div>
        {{-- <a href="/surat-keluar/index" class="btn btn-warning">Kembali</a> --}}
      </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <form method="post" action="/spo/tambah" enctype="multipart/form-data">
              @csrf

                <div class="row mb-3">
                  <label for="tanggalSurat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                  <div class="col-sm-9">
                    <input name="tanggalSurat" type="date" class="form-control" id="tanggalSurat" value="{{ old('tanggalSurat') }}" required>
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="tujuan" class="col-sm-3 col-form-label">Tujuan</label>
                    <div class="col-sm-9">
                      <input name="tujuan" type="text" class="form-control" id="tujuan" value="{{ old('tujuan') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="perihal" id="perihal" rows="3" required>{{ old('perihal') }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="direktorat" class="col-sm-3 col-form-label">Direktorat</label>
                    <div class="col-sm-9">
                      <select name="direksi" class="form-select" id="direktorat" required>
                          <option value="">Pilih Direksi</option>
                          @foreach ($direksi as $d)
                        
                          <option value="{{ $d->id }}" @if ($d->id == old('direksi'))
                            selected
                            @endif>{{ $d->namaDireksi }}</option>

                          @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fileSurat" class="col-sm-3 col-form-label">Upload Surat</label>
                    <div class="col-sm-9">
                        <input name="fileSurat" class="form-control @error('fileSurat') is-invalid @enderror" type="file" id="fileSurat" required>
                      @error('fileSurat')
                      <div id="fileSurat" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <textarea name="keterangan" class="form-control" name="keterangan" id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
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