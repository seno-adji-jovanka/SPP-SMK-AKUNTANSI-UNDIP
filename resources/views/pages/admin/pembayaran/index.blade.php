@extends('layouts.master')
@section('title', 'Pembayaran SPP')

@section('content')


  <!-- Contoh Modal -->
  <div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSayaLabel">Data Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive px-3">
                <table id="siswaTable" class="table table-striped" >
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>NISN</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Kelas</th>
                          <th>Jurusan</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>

                      @foreach($siswaList as $i => $sis)
                        <tr>
                            <td>{{ $i += 1 }}</td>
                            <td>{{ $sis->nisn }}</td>
                            <td>{{ $sis->nis }}</td>
                            <td>{{ $sis->nama }}</td>
                            <td>{{ $sis->kelas->nama_kelas }}</td>
                            <td>{{ $sis->kelas->kompetensi_keahlian }}</td>
                            <td>
                               <form action="" method="GET">
                                <button type="submit" name="nisn" value="{{ $sis->nisn }}" class="btn btn-info">Pilih</button>
                               </form>
                            </td>
                        </tr>

                      @endforeach
                  </tbody>
                </table>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pembayaran SPP</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col">
              <div class="card">
                <!-- <div class="card-header">
                  <a href="{{ route('data-kelas.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div> -->
                <div class="card-body p-0">
                   <div class="row">
                       <div class="col">
                        <form action="" method="GET">
                            <div class="card-body">
                              <div class="form-group">
                                <label for="nis">Input NISN</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" autocomplete="off" value="{{ old('nisn') }}" placeholder="Masukan NISN disini!" required>
                                  <div class="input-group-append">
                                    <button class="btn btn-info" type="submit"><i class="fas fa-search"></i> Cari</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                       </div>
                       <div class="col">
                        <form action="" method="GET">
                            <div class="card-body">
                              <div class="form-group">
                                <label for="nis">Cari Berdasarkan Nama</label>
                                <div class="input-group mb-3">
                                  <!-- <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" value="{{ old('nisn') }}" placeholder="Masukan NISN disini!" required> -->
                                  <div class="">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalSaya"><i class="fas fa-user"></i> Cari Nama</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                       </div>
                   </div>
                </div>
              </div>
            </div>
          </div>

          @if(\Request()->nisn)
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                    <h5>Detail Data Siswa</h5>
                </div>

                <div class="card-body p-0">
                    <div class="card-body">
                    <!-- <form action="" method="GET" class="">
                        @csrf
                          <div class="form-group">
                              <label for="nis">Nama</label>
                            <div class="input-group mb-3">
                                <text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" value="{{ request()->get('nisn') ? $siswa->nama : '' }}" readonly required>

                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" value="{{ request()->get('nisn') ? "Rp. " . number_format($siswa->spp->nominal, 0) : '' }}" readonly required>
                              </div>
                          </div>
                        </form> -->
                        <form action="{{ route('pembayaran.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>NISN</label>
                                    <input type="text" name="nisn" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? $siswa->nisn : '' }}" readonly>
                                  </fieldset>
                                </div>
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? $siswa->nis : '' }}" readonly>
                                  </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? $siswa->nama : '' }}" readonly>
                                  </fieldset>
                                </div>
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? $siswa->kelas->nama_kelas : '' }}" readonly>
                                  </fieldset>
                                </div>
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input type="enum" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? $siswa->jenkel : '' }}" readonly>
                                  </fieldset>
                                </div>
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>Kompetensi Keahlian</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? $siswa->kelas->kompetensi_keahlian : '' }}" readonly>
                                  </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>Tahun</label>
                                    <input type="text" name="tahun_bayar" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? $siswa->spp->tahun : '' }}" readonly>
                                  </fieldset>
                                </div>
                                <div class="col">
                                  <fieldset class="form-group">
                                    <label>Nominal</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{ request()->get('nisn') ? 'Rp. ' . number_format($siswa->spp->nominal, 0,'', '.') : '' }}" readonly>
                                  </fieldset>
                                </div>
                                <!-- <div class="col">
                                    <fieldset class="form-group">
                                      <label>Status</label>
                                      <select class="custom-select @error('status') is-invalid @enderror" name="status" required>
                                            <option disabled selected>Silahkan Pilih</option>
                                             <option value="sudahbayar">Sudah Bayar</option>
                                             <option value="belumbayar">Belum Bayar</option>
                                      </select>
                                    </fieldset>
                                </div> -->
                                <div class="col">
                                    <fieldset class="form-group">
                                      <label>Bulan</label>
                                      <select class="custom-select @error('bulan_bayar') is-invalid @enderror" name="bulan_bayar" required>
                                            <option disabled selected>Silahkan Pilih</option>
                                             <option value="januari">Januari</option>
                                             <option value="februari">Februari</option>
                                             <option value="maret">Maret</option>
                                             <option value="april">April</option>
                                             <option value="mei">Mei</option>
                                             <option value="juni">Juni</option>
                                             <option value="juli">Juli</option>
                                             <option value="agustus">Agustus</option>
                                             <option value="september">September</option>
                                             <option value="oktober">Oktober</option>
                                             <option value="november">November</option>
                                             <option value="desember">Desember</option>
                                   </select>
                                    </fieldset>
                                  </div>
                            </div>
                            <input type="hidden" value="{{ request()->get('nisn') ? $siswa->id_spp : '' }}"  name="id_spp" id="">
                            <input type="hidden" value="{{ request()->get('nisn') ? $siswa->spp->nominal : '' }}"  name="jumlah_bayar" id="">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-money-bill-wave"></i> Bayar</button>
                        </form>
                    </div>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                 <h5>Riwayat Pembayaran</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive p-3">
                        <table id="sppTable" class="table table-striped" >
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Pengguna</th>
                                  <th>Tanggal Bayar</th>
                                  <th>SPP Bulan</th>
                                  <th>SPP Tahun</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @if(request()->get('nisn'))
                            @forelse($history_spp as $i => $spp)
                               <tr>
                                    <td>{{ $i += 1 }}</td>
                                    <td>{{ $spp->user->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($spp->tanggal_bayar)->format('d-m-Y') }}</td>
                                    <td>{{ ucfirst($spp->bulan_bayar) }}</td>
                                    <td>{{ $spp->tahun_bayar }}</td>
                                    <td>{{ $spp->status }}</td>
                                    <td>
                                        <form action="{{ url('pembayaran/cetak', $spp->id_pembayaran) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info">Cetak</button>
                                        </form>
                                    </td>
                               </tr>
                               @empty
                               <p>Data Kosong</p>
                               @endforelse
                               @endif
                          </tbody>
                        </table>
                      </div>
                </div>
              </div>
            </div>
          </div>
          @endif
      </div>
    </section>
  </div>

@endsection

@push('addon-script')
  <!-- Page Specific JS File -->
  <!-- <script src="{{  asset('../assets/js/page/bootstrap-modal.js') }}"></script> -->
<script>

    $(document).ready(function() {
        $('#sppTable').DataTable();
    } );
    $(document).ready(function() {
        $('#siswaTable').DataTable();
    } );
</script>
@endpush
