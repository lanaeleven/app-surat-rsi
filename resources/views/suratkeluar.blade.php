@extends('layouts.main')

@section('container')
<div class="div">
    <h3 class="fw-bold fs-4 mb-3">Surat Keluar</h3>
    <div class="div">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kepada</th>
                <th scope="col">Perihal</th>
                <th scope="col">Direktorat</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jenis</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @for ($i = 10 ; $i > 0 ; $i--)
                    
                
              <tr>
                <th scope="row">{{ $i }}</th>
                <td>01/04/2024</td>
                <td>Puskesmas Landasan Ulin Barat</td>
                <td>Penawaran</td>
                <td>Direktur</td>
                <td>Penawaran Kerja Sama</td>
                <td>B-Umum</td>
                <td>
                    <button type="button" class="mt-1 btn btn-success"><i class="lni lni-pencil"></i></i></button>
                </td>
              </tr>
              @endfor
              
            </tbody>
          </table>
    </div>

</div>
@endsection