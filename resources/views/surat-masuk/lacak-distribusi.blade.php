{{-- @dd($jenisSurat[0]->kodeJenisSurat.'-'.$jenisSurat[0]->keterangan) --}}

@php
    // $distribusiSurat = $distribusiSurat[0];
@endphp
{{-- @dd($distribusiSurat) --}}

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
    <h3 class="fw-bold fs-4 mb-3 text-center">Distribusi Surat</h3>
    <div class="d-flex justify-content-center">
        <div class="col-9">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="2" class="text-center">
                             Status: {{ $suratMasuk->status }}
                        </th>
                    </tr>
                    
                    <tr>
                        <td>
                            <table class="table">
                                <tbody>
                                    
                                    <tr>
                                        <td>Indeks</td>
                                        <td>{{ $suratMasuk->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Surat</td>
                                        <td>{{ $suratMasuk->tanggalSurat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dari</td>
                                        <td>{{ $suratMasuk->pengirim }}</td>                                        
                                    </tr>
                                    <tr>
                                        <td>Direksi</td>
                                        <td>{{ $suratMasuk->direksi->namaDireksi }}</td>
                                    </tr>                                    
                                </tbody>
                                </table>
                        </td>
                        <td>
                            <table class="table">
                                <tbody>                                
                                    <tr>
                                        <td>Nomor Surat</td>
                                        <td>{{ $suratMasuk->nomorSurat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Agenda</td>
                                        <td>{{ $suratMasuk->tanggalAgenda }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sifat Surat</td>
                                        <td>{{ $suratMasuk->sifatSurat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Perihal</td>
                                        <td>{{ $suratMasuk->perihal }}</td>
                                    </tr>
                                    
                                </tbody>
                                </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <div>
                                    File surat: {{ $suratMasuk->fileName }} 
                                </div>
                                 <div class="ms-2">
                                     <a href="{{ asset('storage/' . $suratMasuk->filePath) }}" class="mt-1 btn btn-success btn-sm" target="_blank">view</a>
                                    <a href="{{ asset('storage/' . $suratMasuk->filePath) }}" class="mt-1 btn btn-primary btn-sm" download='{{ $suratMasuk->fileName }}'>download</a>                          
                                 </div>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
            
        </div>
        
    </div>

    <div class="row d-flex justify-content-center">
    @if ($distribusiSurat->isNotEmpty())
        <h4 class="text-center mt-3">Terusan Surat</h4>
    @endif
        @foreach ($distribusiSurat as $ds)
            
        <div class="col-9 my-3">
            <form>
            <div class="row mb-3">
                <label for="tujuan" class="col-sm-3 col-form-label">Oleh</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" value="{{ $ds->pengirimDisposisi->namaTujuanDisposisi }}" aria-label="Disabled input example" disabled readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tujuan" class="col-sm-3 col-form-label">Kepada</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" value="{{ $ds->tujuanDisposisi->namaTujuanDisposisi }}" aria-label="Disabled input example" disabled readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tujuan" class="col-sm-3 col-form-label">Tanggal Diteruskan</label>
                <div class="col-sm-9">
                    <input class="form-control" type="date" value="{{ $ds->tanggalDiteruskan }}" aria-label="Disabled input example" disabled readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="instruksi" class="col-sm-3 col-form-label">Instruksi</label>
                <div class="col-sm-9">
                  <textarea class="form-control" name="instruksi" id="instruksi" rows="3" disabled readonly>{{ $ds->instruksi }}</textarea>
                </div>
            </div>
            
            </form>
            <hr>
        </div>

        

        @endforeach
    </div>
</div>

@endsection