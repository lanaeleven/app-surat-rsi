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
                <form class="row g-3" action="/informasi/index/ns">
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
                            <select name="jenisInformasi" class="form-select form-select-sm"
                                value="{{ request('jenisInformasi') }}">
                                <option value="">Semua Jenis Informasi</option>
                                @foreach ($jenisInformasi as $ji)
                                    <option value="{{ $ji->id }}"
                                        {{ request('jenisInformasi') == $ji->id ? 'selected' : '' }}>{{ $ji->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <input name="judul" type="text" class="form-control form-control-sm" placeholder="Judul"
                                value="{{ request('judul') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass"
                                    style="color: #ffffff;"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            @if ($informasi->isEmpty())

                <p class="text-center fs-6 my-5">Anda Tidak Memiliki {{ $judul }}</p>
            @else
                <div>
                    <table class="table table-striped  d-none d-md-table d-lg-table d-xl-table d-xxl-table">
                        <thead>
                            <tr>
                                <th scope="col">Indeks</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($informasi as $i)
                                <tr>
                                    <th scope="row">{{ $i->index }}</th>
                                    <td>{{ $i->judul }}</td>
                                    <td>{{ $i->jenisinformasi->nama }}</td>
                                    <td>{{ $i->tanggalSurat }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $i->filePath) }}"
                                            class="mt-1 btn btn-sm btn-secondary" target="_blank"><i class="fa-solid fa-eye"
                                                style="color: #ffffff;"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{-- Tampilan SPO pada mobile device --}}
                    @foreach ($informasi as $i)
                        <div class="col-12 d-md-none d-lg-none d-xl-none d-xxl-none mt-3 mb-5">
                            <div class="card shadow">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Indeks</th>
                                        <td>{{ $i->index }}</td>
                                    </tr>
                                    <tr>
                                        <th>Judul</th>
                                        <td>{{ $i->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis</th>
                                        <td>{{ $i->jenisinformasi->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $i->tanggalSurat }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <a href="/informasi/edit/{{ $i->id }}"
                                                class="mt-1 btn btn-sm btn-primary"><i class="fa-solid fa-pencil"
                                                    style="color: #ffffff;"></i></a>
                                            <a href="{{ asset('storage/' . $i->filePath) }}"
                                                class="mt-1 btn btn-sm btn-success" download='{{ $i->fileName }}'><i
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
                        {{ $informasi->appends(request()->input())->links() }}
                    </div>
                </div>
            @endif
        </div>
    @endsection
