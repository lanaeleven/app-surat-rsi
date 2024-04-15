{{-- @dd($jenisSurat[0]->kodeJenisSurat.'-'.$jenisSurat[0]->keterangan) --}}
{{-- @dd($direksi) --}}
@extends('layouts.main')

@section('container')
    
<div>
    <h3 class="fw-bold fs-4 mb-3 text-center">Tambah Surat Keluar</h3>
    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/surat-keluar/tambah" enctype="multipart/form-data">
              @csrf

                <div class="row mb-3">
                  <label for="jenisSurat" class="col-sm-3 col-form-label">Jenis Surat</label>
                  <div class="col-sm-9">
                    <select name="jenisSurat" class="form-select" id="jenisSurat" required>
                        <option value="">Pilih Jenis Surat</option>
                        @foreach ($jenisSurat as $js)
                          <option value="{{ $js->id }}">{{ $js->kodeJenisSurat.'-'.$js->keterangan }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="tanggalSurat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                  <div class="col-sm-9">
                    <input name="tanggalSurat" type="date" class="form-control" id="tanggalSurat" required>
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="tujuan" class="col-sm-3 col-form-label">Tujuan</label>
                    <div class="col-sm-9">
                      <input name="tujuan" type="text" class="form-control" id="tujuan" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="perihal" id="perihal" rows="3" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="direktorat" class="col-sm-3 col-form-label">Direktorat</label>
                    <div class="col-sm-9">
                      <select name="direksi" class="form-select" id="direktorat" required>
                          <option value="">Pilih Direksi</option>
                          @foreach ($direksi as $d)
                        
                          <option value="{{ $d->id }}">{{ $d->namaDireksi }}</option>

                          @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fileSurat" class="col-sm-3 col-form-label">Upload Surat</label>
                    <div class="col-sm-9">
                        <input name="fileSurat" class="form-control" type="file" id="fileSurat" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <textarea name="keterangan" class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                  <div>
                    <a href="/surat-keluar/index" class="btn btn-warning mt-3 me-4">Kembali</a>
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