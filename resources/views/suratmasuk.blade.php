@extends('layouts.main')

@section('container')
<div class="div">
    <h3 class="fw-bold fs-4 mb-3">Surat Masuk</h3>
    <div class="div">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Indeks</th>
                <th scope="col">Direktorat</th>
                <th scope="col">Tgl Agenda</th>
                <th scope="col">Dari</th>
                <th scope="col">Tgl Surat</th>
                <th scope="col">No Surat</th>
                <th scope="col">Prihal</th>
                <th scope="col">Distribusi Terakhir</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @for ($i = 10 ; $i > 0 ; $i--)
                    
                
              <tr>
                <th scope="row">{{ $i }}</th>
                <td>Direktur</td>
                <td>05/04/2024</td>
                <td>Unit Dakwah</td>
                <td>01/04/2024</td>
                <td>001/RSI/2024</td>
                <td>Laporan Kegiatan</td>
                <td>2024-04-05 Penjab</td>
                <td>
                    <button type="button" class="mt-1 btn btn-success"><i class="lni lni-pencil"></i></i></button>
                    <button type="button" class="mt-1 btn btn-primary"><i class="lni lni-printer"></i></button>
                    <button type="button" class="mt-1 btn btn-secondary"><i class="lni lni-information"></i></button>
                </td>
              </tr>
              @endfor
              
            </tbody>
          </table>
    </div>

</div>
@endsection