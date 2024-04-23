
@extends('layouts.main')

@section('container')
    
<div>
    <h3 class="fw-bold fs-4 mb-3 text-center">Tambah User</h3>
    <div class="d-flex justify-content-center">
        <div class="col-6">
            <form method="post" action="/user/tambah">
              @csrf

              <div class="row mb-3">
                <label for="divisi" class="col-sm-3 col-form-label">Divisi</label>
                <div class="col-sm-9">
                  <select name="divisi" class="form-select @error('divisi') is-invalid @enderror" id="divisi" required>
                      <option value="">Pilih Divisi User</option>
                      <option value="admin" @if (old('divisi') === 'admin')
                          selected
                      @endif>Administrator</option>
                      <option value="direktur" @if (old('divisi') === 'direktur')
                      selected
                      @endif>Direktur</option>
                      <option value="umum dan dakwah" @if (old('divisi') === 'umum dan dakwah')
                      selected
                      @endif>Umum dan Dakwah</option>
                      <option value="sdi dan keuangan" @if (old('divisi') === 'sdi dan keuangan')
                      selected
                      @endif>SDI dan Keuangan</option>
                    </select>
                    @error('divisi')
                      <div id="divisi" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="level" class="col-sm-3 col-form-label">Level</label>
                <div class="col-sm-9">
                  <select name="level" class="form-select @error('level') is-invalid @enderror" id="level" required>
                      <option value="">Pilih Level User</option>
                      <option value="admin" @if (old('level') === 'admin')
                          selected
                      @endif>Administrator</option>
                      <option value="direktur" @if (old('level') === 'direktur')
                      selected
                      @endif>Direktur</option>
                      <option value="kepala" @if (old('level') === 'kepala')
                      selected
                      @endif>Kepala Bagian</option>
                      <option value="penjab" @if (old('level') === 'penjab')
                      selected
                      @endif>Penanggung Jawab Bagian</option>
                    </select>
                    @error('level')
                      <div id="level" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                </div>
              </div>

                <div class="row mb-3">
                    <label for="namaJabatan" class="col-sm-3 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-9">
                      <input name="namaJabatan" type="text" class="form-control @error('namaJabatan') is-invalid @enderror" id="namaJabatan" value="{{ old('namaJabatan') }}" required>
                      @error('namaJabatan')
                      <div id="namaJabatan" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="username" class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" required>
                    @error('username')
                      <div id="username" class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                  </div>
               </div>

               <div class="row mb-3">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                  @error('password')
                    <div id="password" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                </div>
             </div>

                <div class="d-flex justify-content-center">
                  <div>
                    <a href="/user/index" class="btn btn-warning mt-3 me-4">Kembali</a>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-success mt-3">Tambah</button>
                  </div>
                </div>
                  
              </form>
        </div>
    </div>
</div>

@endsection