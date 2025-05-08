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

            {{-- <div>
                <form class="row g-3" action="/undangan/index/ns">
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
                            <input name="judul" type="text" class="form-control form-control-sm" placeholder="Judul"
                                value="{{ request('judul') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-magnifying-glass"
                                    style="color: #ffffff;"></i></button>
                        </div>
                    </div>
                </form>
            </div> --}}

            @if ($undangan->isEmpty())

                <p class="text-center fs-6 my-5">Anda Tidak Memiliki {{ $judul }}</p>
            @else
                <div>
                    <table
                        class="table table-striped table-bordered d-none d-md-table d-lg-table d-xl-table d-xxl-table mt-2"
                        id="table-with-datatable">

                        <thead>
                            <tr>
                                <th scope="col">Index</th>
                                <th scope="col">Judul Kegiatan</th>
                                <th scope="col">Tempat Kegiatan</th>
                                <th scope="col">Waktu Kegiatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            <tr>
                                <th><input type="text" placeholder="Cari Index" class="form-control" /></th>
                                <th><input type="text" placeholder="Cari Judul" class="form-control" /></th>
                                <th><input type="text" placeholder="Cari Tempat" class="form-control" /></th>
                                <th><input type="text" placeholder="Cari Waktu" class="form-control" /></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($undangan as $u)
                                <tr>
                                    <td>{{ $u->index }}</td>
                                    <td>{{ $u->judul }}</td>
                                    <td>{{ $u->tempatKegiatan }}</td>
                                    <td>
                                        {{ $u->waktuKegiatan }}
                                        @if (!(\Carbon\Carbon::parse($u->waktuKegiatan)->lessThan($waktuSekarang)))
                                        <i class="fas fa-clock blink" style="color: #f35e5e;"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="mt-1 btn btn-sm btn-warning" data-isi="{!! htmlspecialchars($u->isi, ENT_QUOTES) !!}"
                                            onclick="liatData(this)"><i class="fa-solid fa-eye"
                                                style="color: #ffffff;"></i></button>

                                        @if ($u->filePath)
                                            <a href="{{ asset('storage/' . $u->filePath) }}"
                                                class="mt-1 btn btn-sm btn-secondary" target="_blank"><i
                                                    class="fa-solid fa-file" style="color: #ffffff;"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{-- Tampilan SPO pada mobile device --}}
                    @foreach ($undangan as $i)
                        <div class="col-12 d-md-none d-lg-none d-xl-none d-xxl-none mt-3 mb-5">
                            <div class="card shadow">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Judul</th>
                                        <td>{{ $u->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Kegiatan</th>
                                        <td>{{ $u->tempatKegiatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Kegiatan</th>
                                        <td>{{ $u->waktuKegiatan }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button class="mt-1 btn btn-sm btn-warning" data-isi="{!! htmlspecialchars($u->isi, ENT_QUOTES) !!}"
                                                onclick="liatData(this)"><i class="fa-solid fa-eye"
                                                    style="color: #ffffff;"></i></button>

                                            @if ($u->filePath)
                                                <a href="{{ asset('storage/' . $u->filePath) }}"
                                                    class="mt-1 btn btn-sm btn-secondary" target="_blank"><i
                                                        class="fa-solid fa-file" style="color: #ffffff;"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <!-- Modal -->
                    <div class="modal fade" id="isiModal" tabindex="-1" aria-labelledby="isiModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Isi Undangan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="isiContainer" style="max-height: 700px; overflow-y: auto;">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- <div class="d-flex justify-content-center">
                    <div>
                        {{ $undangan->appends(request()->input())->links() }}
                    </div>
                </div> --}}

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

                <script>
                    function liatData(el) {
                        const isi = el.getAttribute('data-isi');
                        document.getElementById('isiContainer').innerHTML = isi;
                        new bootstrap.Modal(document.getElementById('isiModal')).show();
                    }


                    $(document).ready(function() {
                        $('#table-with-datatable thead tr:eq(1) th').each(function(i) {
                            $('input', this).on('keyup change', function() {
                                if ($('#table-with-datatable').DataTable().column(i).search() !== this.value) {
                                    $('#table-with-datatable').DataTable()
                                        .column(i)
                                        .search(this.value)
                                        .draw();
                                }
                            });
                        });

                        $('#table-with-datatable').DataTable({
                            orderCellsTop: true,
                            fixedHeader: true,
                            order: [
                                [3, 'desc']
                            ]
                        });
                    });
                </script>
            @endif
        </div>
    @endsection
