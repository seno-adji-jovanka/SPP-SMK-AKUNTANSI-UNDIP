@extends('layouts.master')
@section('title', 'Laporan')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Laporan</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                      <h5>Filter Data</h5>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ url('getlaporan') }}" method="POST">
                            @csrf
                            <div class="form-group px-3">
                                <label>Kelas</label>
                                <select name="kelas" class="custom-select @error('kelas') is-invalid @enderror" {{ count($kelas) == 0 ? 'disabled' : '' }}>
                                    @if(count($kelas) == 0)
                                       <option>Pilihan tidak ada</option>
                                    @else
                                       <option value="">Silahkan Pilih</option>
                                          @foreach($kelas as $kls)
                                             <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                                          @endforeach
                                    @endif
                                </select>
                              </div>
                              <hr style="border-color: #f9f9f9 !important;">
                              <div class="form-group px-3">
                                  <label for="">Rentang Tanggal</label>
                                <input type="text" name="date_from" class="form-control" placeholder="Tanggal Awal"
                                    onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $from ?? '' }}">
                                </div>
                                <div class="form-group px-3">
                                    <input type="text" name="date_to" class="form-control" placeholder="Tanggal Akhir"
                                        onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $to ?? '' }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cari Data</button>
                                </div>
                                <p class="text-muted px-2">*Jika ingin mengeksport semua data abaikan form diatas, dan langsung klik cari data.</p>
                        </form>
                    </div>
                  </div>
            </div>
            <div class="col-8">
                <div class="card">
                   <div class="row">
                       <div class="col">
                        <div class="card-header">
                            <h5>Hasil Filter</h5>
                          </div>
                       </div>
                       <div class="col">
                        <div class="float-right pt-3 pr-3">
                        @if ($pembayaran ?? '')
                          <form action="{{ url('laporan/export') }}" method="POST">
                              @csrf
                              <input type="hidden" name="kelas" value="{{ $kelass }}">
                              <input type="hidden" name="date_from" value="{{ $from }}">
                              <input type="hidden" name="date_to" value="{{ $to }}">
                              <button type="submit" class="btn btn-info">EXPORT PDF</button>
                          </form>
                          @endif
                      </div>
                    </div>
                   </div>
                    <div class="card-body p-0">
                        <div class="table-responsive p-3">
                            @if ($pembayaran ?? '')
                        <table class="table" id="pembayaranTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Petugas</th> -->
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>SPP Bulan</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayaran as $k => $v)
                                <tr>
                                    <td>{{ $k += 1 }}</td>
                                    <!-- <td>{{ $v->user->name }}</td> -->
                                    <td>{{ $v->siswa->nama }}</td>
                                    <td>{{ $v->siswa->kelas->nama_kelas }}</td>
                                    <td>{{ ucfirst($v->bulan_bayar) }}</td>
                                    <td>{{ "Rp. " . number_format($v->jumlah_bayar, 0, '', '.') }}</td>
                                    <td>{{ $v->tanggal_bayar }}</td>
                                    <td>{{ $v->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center">
                            Tidak ada data
                        </div>
                        @endif
                        </div>

                    </div>
                  </div>
            </div>
        </div>
      </div>
    </section>
  </div>

@endsection
@push('addon-script')
    @if ($pembayaran ?? '')
        @if ($kelass != null)
        <script>
            $(document).ready(function() {
                $('#{{ $kelass }}').prop('checked', true);
            });
        </script>
        @endif
    @endif
    <script>
         $(document).ready(function() {
        $('#pembayaranTable').DataTable();
    } );
    </script>
@endpush
