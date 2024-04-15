{{-- @dd($jenisSurat[0]->kodeJenisSurat.'-'.$jenisSurat[0]->keterangan) --}}
{{-- @dd($direksi) --}}
@extends('layouts.main')

@section('container')
    
<div>
    <h3 class="fw-bold fs-4 mb-3 text-center">Tambah Surat Masuk</h3>
    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/surat-masuk/tambah" enctype="multipart/form-data">
              @csrf

              <div class="row mb-3">
                <label for="tanggalAgenda" class="col-sm-3 col-form-label">Tanggal Agenda</label>
                <div class="col-sm-9">
                  <input name="tanggalAgenda" type="date" class="form-control" id="tanggalAgenda" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="sifatSurat" class="col-sm-3 col-form-label">Sifat Surat</label>
                <div class="col-sm-9">
                  <select name="sifatSurat" class="form-select" id="sifatSurat" required>
                      <option value="">Pilih Sifat Surat</option>
                      <option value="Biasa">Biasa</option>
                      <option value="Rahasia">Rahasia</option>
                      <option value="Segera">Segera</option>
                    </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="nomorSurat" class="col-sm-3 col-form-label">Nomor Surat</label>
                <div class="col-sm-9">
                  <input name="nomorSurat" type="text" class="form-control" id="nomorSurat" required>
                </div>
            </div>

                <div class="row mb-3">
                  <label for="tanggalSurat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                  <div class="col-sm-9">
                    <input name="tanggalSurat" type="date" class="form-control" id="tanggalSurat" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="lampiran" class="col-sm-3 col-form-label">Lampiran</label>
                  <div class="col-sm-9">
                    <select name="lampiran" class="form-select" id="lampiran" required>
                        <option value="">Ada / Tidak Ada</option>
                        <option value="Ada">Ada</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                      </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="status" class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                    <input name="status" type="text" class="form-control" id="status">
                  </div>
              </div>

              <div class="row mb-3">
                <label for="pengirim" class="col-sm-3 col-form-label">Pengirim</label>
                <div class="col-sm-9">
                  <input name="pengirim" type="text" class="form-control" id="pengirim" required>
                </div>
            </div>

            <div class="row mb-3">
              <label for="direksi" class="col-sm-3 col-form-label">Direktorat</label>
              <div class="col-sm-9">
                <select name="direksi" class="form-select" id="direksi" required>
                    <option value="">Pilih Direksi</option>
                    @foreach ($direksi as $d)
                  
                    <option value="{{ $d->id }}">{{ $d->namaDireksi }}</option>

                    @endforeach
                  </select>
              </div>
            </div>

                <div class="row mb-3">
                    <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="perihal" id="perihal" rows="3" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="fileSurat" class="col-sm-3 col-form-label">Upload Surat</label>
                  <div class="col-sm-9">
                      <input name="fileSurat" class="form-control" type="file" id="fileSurat" required>
                  </div>
              </div>

                  {{-- <div class="row mb-3">
                    <label for="fileSurat" class="col-sm-3 col-form-label">Upload Surat</label>
                    <div class="col-sm-9">
                        <input name="fileSurat" class="form-control" type="file" id="fileSurat" required>
                    </div>
                </div> --}}

                  <div class="d-flex justify-content-center">
                    <div>
                      <a href="/surat-masuk/index" class="btn btn-warning mt-3 me-4">Kembali</a>
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