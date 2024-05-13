
@extends('layouts.main')
{{-- @dd($rekap[0]['namaJabatan']); --}}
@section('container')
<div class="div">
    <h3 class="fw-bold fs-4 mb-3">Rekapitulasi Surat Masuk Berdasarkan Tujuan Disposisi</h3>

    <div>
        <form action="" class="row g-3">

            <div class="col-auto">
                <label for="tanggalAwal" class="col-form-label">Tanggal Awal :</label>
              </div>
            <div class="col-auto">
                <input name="tanggalAwal" type="date" id="tanggalAwal" class="form-control" value="{{ request('tanggalAwal') }}">
            </div> 

            <div class="col-auto ms-3">
                <label for="tanggalAkhir" class="col-form-label">Tanggal Akhir :</label>
              </div>
            <div class="col-auto">
                <input name="tanggalAkhir" type="date" id="tanggalAkhir" class="form-control" value="{{ request('tanggalAkhir') }}">
            </div> 

            <div class="col-auto">
              <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
              </div>
        </form>
    </div>

    <div class="div">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tujuan Disposisi</th>
                <th scope="col">Jumlah Surat</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $total = 0;
                @endphp
              @foreach ($rekap as $r)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $r->namaJabatan }}</td>
                    <td>{{ $r->surat->count() }}</td>
                  </tr>
                  @php
                    $no++;
                    $total += $r->surat->count();
                  @endphp
              @endforeach
              <tr>
                <th colspan="2">Total</th>
                <th>{{ $total }}</th>
              </tr>
            </tbody>
          </table>
    </div>

</div>
@endsection