@extends('layouts.master')
@section('title', 'Data Siswa')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Data Siswa</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-siswa.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('data-siswa.update', $siswa->nisn) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- <div class="card-header">
                          <h4>Isi Data Berikut</h4>
                        </div> -->
                        <div class="card-body">
                          <div class="form-group">
                            <label>NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" autocomplete="off" value="{{ $siswa->nisn }}" required>
                            <!-- @error('nisn')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror -->
                          </div>
                          <div class="form-group">
                            <label>NIS</label>
                            <input type="text"class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis" autocomplete="off" value="{{ $siswa->nis }}" required>
                            <!-- @error('nis')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror -->
                          </div>
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text"class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" autocomplete="off" value="{{ $siswa->nama }}" required>
                          </div>
                          <!-- <div class="form-group">
                            <label>Password</label>
                            <input type="password"class="form-control" name="password" id="password" placeholder="*tidak perlu diisi jika tidak diubah">
                          </div> -->
                          <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" class="custom-select @error('id_kelas') is-invalid @enderror" {{ count($kelas) == 0 ? 'disabled' : '' }}>
                                @if(count($kelas) == 0)
                                   <option>Pilihan tidak ada</option>
                                @else
                                    <option value="">Silahkan Pilih</option>
                                        @foreach($kelas as $value)
                                        <option value="{{ $value->id_kelas }}" {{ $siswa->id_kelas == $value->id_kelas ? 'selected' : '' }}>{{ $value->nama_kelas }}</option>
                                        @endforeach
                                @endif
                            </select>
                          </div>
                          <div class="form-group">
                          <label for="">Jenis Kelamin</label>
                          <select name="jenkel" class="custom-select @error('jenkel') is-invalid @enderror">
                              <option value="">Silahkan Pilih</option>
                              <option value="Laki-laki" {{ $siswa->jenkel == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                              <option value="Perempuan" {{ $siswa->jenkel == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                       </select>
                        </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text"class="form-control @error('alamat') is-invalid @enderror" rows="5" name="alamat" id="alamat" required>{{ $siswa->alamat }}</textarea>
                          </div>
                          <div class="form-group">
                            <label>No Telpon</label>
                            <input type="text"class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" autocomplete="off" value="{{ $siswa->no_telp }}" required>
                          </div>
                          <div class="form-group mb-0">
                            <label>SPP</label>
                            <select name="spp" class="custom-select @error('spp') is-invalid @enderror" {{ count($spp) == 0 ? 'disabled' : '' }}>
                                @if(count($spp) == 0)
                                   <option>Pilihan tidak ada</option>
                                @else
                                <option value="">Silahkan Pilih</option>
                                @foreach($spp as $value)
                                   <option value="{{ $value->id_spp }}" {{ $siswa->id_spp == $value->id_spp ? 'selected' : '' }}>{{ 'Tahun '.$value->tahun.' - '.'Rp.'.$value->nominal }}</option>
                                @endforeach
                                @endif
                            </select>
                          </div>
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
