
@extends('layouts.main')

@section('container')
    
<div>

    <div class="d-flex justify-content-between align-items-center my-4">
      <div>
        <a href="/spo/index" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left" style="color: #000;"></i></a>
      </div>
      <div>
        <h3 class="fw-bold fs-4 text-center">Edit Standar Prosedur Operasional</h3>
      </div>
      <div>
      </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <form method="post" action="/spo/save" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $spo->id }}">
              <input type="hidden" name="index" value="{{ $spo->index }}">
              <input type="hidden" name="tahun" value="{{ $spo->tahun }}">
                <div class="row mb-3">
                  <label for="tanggalSurat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                  <div class="col-sm-9">
                    <input name="tanggalSurat" type="date" class="form-control" id="tanggalSurat" value="{{ $spo->tanggalSurat }}" required>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="tujuan" class="col-sm-3 col-form-label">Tujuan</label>
                    <div class="col-sm-9">
                      <input name="tujuan" type="text" class="form-control" id="tujuan" value="{{ $spo->tujuan }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="perihal" id="perihal" rows="3" required>{{ $spo->perihal }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="direktorat" class="col-sm-3 col-form-label">Direktorat</label>
                    <div class="col-sm-9">
                      <select name="direksi" class="form-select" id="direktorat" required>
                          <option value="">Pilih Direksi</option>
                          @foreach ($direksi as $d)
                        
                          <option value="{{ $d->id }}" @if ($spo->idDireksi === $d->id)
                              selected
                          @endif>{{ $d->namaDireksi }}</option>

                          @endforeach
                        </select>
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                    <label for="fileSurat" class="col-sm-3 col-form-label">File Surat</label>
                    <div class="col-sm-9">
                        <div class="row justify-content-between align-items-center">
                          <div class="col">
                            {{ $spo->fileName }} 
                          </div>
                          <div class="col">
                            <a href="{{ asset('storage/' . $spo->filePath) }}" class="mt-1 btn btn-success btn-sm" target="_blank">view</a>
                            <a href="{{ asset('storage/' . $spo->filePath) }}" class="mt-1 btn btn-primary btn-sm" download='{{ $spo->fileName }}'>download</a>
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
                    
                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <textarea name="keterangan" class="form-control" name="keterangan" id="keterangan" rows="3">{{ $spo->keterangan }}</textarea>
                    </div>
                </div>
                  <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-success mt-3">Simpan</button>
                  </div>
              </form>
        </div>
    </div>
</div>

@endsection