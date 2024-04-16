@extends('layouts.master')
@section('title', 'Data Petugas')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Data Pengguna</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-petugas.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body p-0">
                <form action="{{ route('data-petugas.update', $petugas->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <!-- <div class="card-header">
                          <h4>Isi Data Berikut</h4>
                        </div> -->
                        <div class="card-body">
                          <div class="form-group">
                            <label>Nama Admin</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" value="{{ $petugas->name }}" required>
                          </div>
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" autocomplete="off" value="{{ $petugas->username }}" required>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" autocomplete="off" value="{{ $petugas->email }}" required>
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}" required>
                          </div>
                          <!-- <select name="level" class="custom-select @error('level') is-invalid @enderror">
                              <option value="">Silahkan Pilih</option>
                              <option value="admin" {{ $petugas->level == 'admin' ? 'selected' : '' }}>admin</option>
                              <option value="petugas" {{ $petugas->level == 'petugas' ? 'selected' : '' }}>petugas</option>
                       </select> -->
                        </div>
                        <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>

@endsection

@push('addon-script')

@endpush
