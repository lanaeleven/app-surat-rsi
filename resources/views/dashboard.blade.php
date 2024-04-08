@extends('layouts.main')
@section('container')

      <div class="mb-3">
        <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>

        <div class="col">

        
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">10 Surat</h2>
                  <p class="card-text fs-3">Surat Masuk hari ini</p>
                  <a href="#" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">15 Surat</h2>
                  <p class="card-text fs-3">Surat Keluar hari ini</p>
                  <a href="#" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">150 Surat</h2>
                  <p class="card-text fs-3">Surat Masuk bulan ini</p>
                  <a href="#" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title fw-bold">180 Surat</h2>
                  <p class="card-text fs-3">Surat Keluar bulan ini</p>
                  <a href="#" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
        </div>

    </div>
        
      </div>
@endsection