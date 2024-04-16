@extends('layouts.master')
@section('title', 'Data Siswa')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Siswa</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-siswa.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('data-siswa.store') }}" method="POST">
                        @csrf
                        <!-- <div class="card-header">
                          <h4>Isi Data Berikut</h4>
                        </div> -->
                        <div class="card-body">
                          <div class="form-group">
                            <label>NISN</label>
                            <input type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" autocomplete="off" value="{{ old('nisn') }}" required>
                            @error('nisn')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>NIS</label>
                            <input type="number"class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis" autocomplete="off" value="{{ old('nis') }}" required>
                            @error('nis')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text"class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" autocomplete="off" value="{{ old('nama') }}" required>
                          </div>
                          <!-- <div class="form-group">
                            <label>Password</label>
                            <input type="password"class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                          </div> -->
                          <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="custom-select @error('kelas') is-invalid @enderror" {{ count($kelas) == 0 ? 'disabled' : '' }}>
                                @if(count($kelas) == 0)
                                   <option>Pilihan tidak ada</option>
                                @else
                                   <option value="">Silahkan Pilih</option>
                                      @foreach($kelas as $value)
                                         <option value="{{ $value->id_kelas }}">{{ $value->nama_kelas }}</option>
                                      @endforeach
                                @endif
                            </select>
                          </div>
                          <div class="form-group">
                            <label fzor="">Jenis Kelamin</label>
                            <select name="jenkel" class="custom-select @error('jenkel') is-invalid @enderror">
                                <option value="">Silahkan Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" rows="20" name="alamat" id="alamat" required>{{ old('alamat') }}</textarea>
                          </div>
                          <div class="form-group">
                            <label>No Telpon</label>
                            <input type="number"class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" autocomplete="off" value="{{ old('no_telp') }}" required>
                          </div>
                          <div class="form-group mb-0">
                            <label>SPP</label>
                            <select name="spp" class="custom-select @error('spp') is-invalid @enderror" {{ count($spp) == 0 ? 'disabled' : '' }}>
                                @if(count($spp) == 0)
                                   <option>Pilihan tidak ada</option>
                                @else
                                   <option value="">Silahkan Pilih</option>
                                      @foreach($spp as $value)
                                         <option value="{{ $value->id_spp }}">{{ 'Tahun '.$value->tahun.' - '.'Rp. '.number_format($value->nominal,0,'.','.') }}</option>
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
