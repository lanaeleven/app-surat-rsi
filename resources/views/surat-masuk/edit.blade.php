{{-- @dd($jenisSurat[0]->kodeJenisSurat.'-'.$jenisSurat[0]->keterangan) --}}
{{-- @dd($suratMasuk) --}}
@extends('layouts.main')

@section('container')
    
<div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    <div class="d-flex justify-content-between align-items-center my-4">
      <div>
        {{-- <a href="/surat-masuk/index" class="btn btn-warning btn-sm d-none d-md-block d-lg-block d-xl-block d-xxl-block">Kembali</a> --}}
        <a href="/surat-masuk/index" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left" style="color: #000;"></i></a>
      </div>
      <div>
        <h3 class="fw-bold fs-4 text-center">Edit Surat Masuk</h3>
      </div>
      <div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <form method="post" action="/surat-masuk/save" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $suratMasuk->id }}">
              <div class="row mb-3">
                <label for="tanggalAgenda" class="col-sm-3 col-form-label">Tanggal Agenda</label>
                <div class="col-sm-9">
                  <input name="tanggalAgenda" type="date" class="form-control" id="tanggalAgenda" value="{{ $suratMasuk->tanggalAgenda }}" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="sifatSurat" class="col-sm-3 col-form-label">Sifat Surat</label>
                <div class="col-sm-9">
                  <select name="sifatSurat" class="form-select" id="sifatSurat" required>
                      <option value="">Pilih Sifat Surat</option>
                      <option value="Biasa" @if ($suratMasuk->sifatSurat === 'Biasa')
                          selected
                      @endif
                      >Biasa</option>
                      <option value="Rahasia" @if ($suratMasuk->sifatSurat === 'Rahasia')
                        selected
                    @endif
                    >Rahasia</option>
                      <option value="Segera" @if ($suratMasuk->sifatSurat === 'Segera')
                        selected
                    @endif
                    >Segera</option>
                    </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="nomorSurat" class="col-sm-3 col-form-label">Nomor Surat</label>
                <div class="col-sm-9">
                  <input name="nomorSurat" type="text" class="form-control" id="nomorSurat" value="{{ $suratMasuk->nomorSurat }}" required>
                </div>
            </div>

                <div class="row mb-3">
                  <label for="tanggalSurat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                  <div class="col-sm-9">
                    <input name="tanggalSurat" type="date" class="form-control" id="tanggalSurat" value="{{ $suratMasuk->tanggalSurat }}" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="lampiran" class="col-sm-3 col-form-label">Lampiran</label>
                  <div class="col-sm-9">
                    <select name="lampiran" class="form-select" id="lampiran" required>
                        <option value="">Ada / Tidak Ada</option>
                        <option value="Ada" @if ($suratMasuk->lampiran === "Ada")
                            selected
                        @endif>Ada</option>
                        <option value="Tidak Ada" @if ($suratMasuk->lampiran === "Tidak Ada")
                          selected
                      @endif>Tidak Ada</option>
                      </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="status" class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                    <input name="status" type="text" class="form-control" id="status" value="{{ $suratMasuk->status }}">
                  </div>
              </div>

              <div class="row mb-3">
                <label for="pengirim" class="col-sm-3 col-form-label">Pengirim</label>
                <div class="col-sm-9">
                  <input name="pengirim" type="text" class="form-control" id="pengirim" value="{{ $suratMasuk->pengirim }}" required>
                </div>
            </div>

            <div class="row mb-3">
              <label for="direksi" class="col-sm-3 col-form-label">Direktorat</label>
              <div class="col-sm-9">
                <select name="direksi" class="form-select" id="direksi" required>
                    <option value="">Pilih Direksi</option>
                    @foreach ($direksi as $d)
                  
                    <option value="{{ $d->id }}" @if ($suratMasuk->idDireksi === $d->id)
                        selected
                    @endif>{{ $d->namaDireksi }}</option>

                    @endforeach
                  </select>
              </div>
            </div>

                <div class="row mb-3">
                    <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="perihal" id="perihal" rows="3" required>{{ $suratMasuk->perihal }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="fileSurat" class="col-sm-3 col-form-label">File Surat</label>
                  <div class="col-sm-9">
                      <div class="row justify-content-between align-items-center">
                        <div class="col">
                          {{ $suratMasuk->fileName }} 
                        </div>
                        <div class="col">
                          <a href="{{ asset('storage/' . $suratMasuk->filePath) }}" class="mt-1 btn btn-success btn-sm" target="_blank">view</a>
                          <a href="{{ asset('storage/' . $suratMasuk->filePath) }}" class="mt-1 btn btn-primary btn-sm" download='{{ $suratMasuk->fileName }}'>download</a>
                        </div>
                      </div>
                    </div>
              </div>

              <div class="row mb-3">
                <label for="fileSurat" class="col-sm-3 col-form-label">Ganti File Surat</label>
                <div class="col-sm-9">
                    <input name="fileSurat" class="form-control" type="file" id="fileSurat"> 
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