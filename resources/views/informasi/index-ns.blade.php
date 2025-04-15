@extends('layouts.main')

@section('container')
    <div class="div">
    @section('container')
        <div>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-center my-2">
                <h3 class="fw-bold fs-4 mb-3">{{ $judul }}</h3>
            </div>

            <div>
                <form class="row g-3" action="/regulasi/index/ns">
                    <div class="row g-3">
                        <div class="col-auto">
                            <label for="tanggalAwal" class="col-form-label"><small>Tanggal Awal :</small></label>
                        </div>
                        <div class="col-auto">
                            <input name="tanggalAwal" type="date" id="tanggalAwal" class="form-control form-control-sm"
                                value="{{ request('tanggalAwal') }}">
                        </div>

                        <div class="col-auto ms-3">
                            <label for="tanggalAkhir" class="col-form-label"><small>Tanggal Akhir :</small></label>
                        </div>
                        <div class="col-auto">
                            <input name="tanggalAkhir" type="date" id="tanggalAkhir" class="form-control form-control-sm"
                                value="{{ request('tanggalAkhir') }}">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-auto">
                            <input name="index" type="number" class="form-control form-control-sm" placeholder="Index"
                                value="{{ request('index') }}">
                        </div>
                        <div class="col-auto">
                            <input name="tujuan" type="text" class="form-control form-control-sm" placeholder="Tujuan"
                                value="{{ request('tujuan') }}">
                        </div>
                        <div class="col-auto">
                            <input name="perihal" type="text" class="form-control form-control-sm" placeholder="Perihal"
                                value="{{ request('perihal') }}">
                        </div>
                        <div class="col-auto">
                            <input name="keterangan" type="text" class="form-control form-control-sm"
                                placeholder="Keterangan" value="{{ request('keterangan') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass"
                                    style="color: #ffffff;"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            @if ($regulasi->isEmpty())

                <p class="text-center fs-6 my-5">Anda Tidak Memiliki {{ $judul }}</p>
            @else
                <div>
                    <table class="table table-striped  d-none d-md-table d-lg-table d-xl-table d-xxl-table">
                        <thead>
                            <tr>
                                <th scope="col">Indeks</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Direktorat</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($regulasi as $r)
                                <tr>
                                    <th scope="row">{{ $r->index }}</th>
                                    <td>{{ $r->tanggalSurat }}</td>
                                    <td>{{ $r->tujuan }}</td>
                                    <td>{{ $r->perihal }}</td>
                                    <td>{{ $r->direksi->namaDireksi }}</td>
                                    @php
                                        $arr = explode(' ', $r->keterangan);

                                    @endphp
                                    <td>
                                        @if (count($arr) > 2)
                                            {{ $arr[0] . ' ' . $arr[1] . '...' }}
                                        @else
                                            {{ $r->keterangan }}
                                        @endif
                                    </td>
                                    <td>{{ $r->jenisRegulasi->keterangan }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $r->filePath) }}"
                                            class="mt-1 btn btn-sm btn-secondary" target="_blank"><i class="fa-solid fa-eye"
                                                style="color: #ffffff;"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{-- Tampilan SPO pada mobile device --}}
                    @foreach ($regulasi as $r)
                        <div class="col-12 d-md-none d-lg-none d-xl-none d-xxl-none mt-3 mb-5">
                            <div class="card shadow">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Indeks</th>
                                        <td>{{ $r->index }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $r->tanggalSurat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tujuan</th>
                                        <td>{{ $r->tujuan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Perihal</th>
                                        <td>{{ $r->perihal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Direktorat</th>
                                        <td>{{ $r->direksi->namaDireksi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>{{ $r->keterangan }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <a href="/regulasi/edit/{{ $r->id }}"
                                                class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil"
                                                    style="color: #ffffff;"></i></a>
                                            <a href="{{ asset('storage/' . $r->filePath) }}"
                                                class="mt-1 btn btn-sm btn-success" download='{{ $r->fileName }}'><i
                                                    class="fa-solid fa-download" style="color: #ffffff;"></i></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="d-flex justify-content-center">
                    <div>
                        {{ $regulasi->appends(request()->input())->links() }}
                    </div>
                </div>
            @endif
        </div>
    @endsection
