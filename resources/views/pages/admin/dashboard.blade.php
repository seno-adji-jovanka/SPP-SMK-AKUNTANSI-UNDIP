@extends('layouts.master')
@section('title', 'Dashboard')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="" class="text-decoration-none">{{ now()->format('l, d F Y') }}</a></div>
          </div>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Uang Masuk</h4>
                  </div>
                  <div class="card-body">
                    {{ number_format($total, 0, '', '.') }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Transaksi</h4>
                  </div>
                  <div class="card-body">
                    {{ $trx }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Siswa</h4>
                  </div>
                  <div class="card-body">
                    {{ $siswa }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-layer-group"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Kelas</h4>
                  </div>
                  <div class="card-body">
                    {{ $kelas}}
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                      <h4>Selamat Datang, {{ Auth::user()->name }}!</h4>
                    </div>
                    <form action="{{ route('pembayaran.index') }}" method="GET">
                        <div class="card-body">
                            <p>Silahkan masukan NISN siswa untuk melakukan transaksi SPP.</p>
                          <div class="form-group">
                            <div class="input-group mb-3">
                              <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" value="{{ old('nisn') }}" placeholder="Masukan NISN disini!" required>
                              <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Riwayat Pembayaran</h4>
                        <div class="card-header-action">
                          <a href="{{ url('histori-pembayaran') }}" class="btn btn-primary">
                            Lihat Semua
                          </a>
                        </div>
                      </div>
                        <div class="card-body">
                            <div class="table-responsive p-3">
                                <table id="siswaTable" class="table table-striped" >
                                  <thead>
                                      <tr>
                                          <!-- <th>Petugas</th> -->
                                          <th>NISN</th>
                                          <th>Nama</th>
                                          <th>Tanggal Bayar</th>
                                          <th>SPP Bulan</th>
                                          <th>SPP Tahun</th>
                                          <th>Jumlah Bayar</th>
                                          <th>Status</th>
                                          <!-- <th>Action</th> -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($pembayaran as $pay)
                                        <tr>
                                            <!-- <td>{{ $pay->user->name }}</td> -->
                                            <td>{{ $pay->nisn }}</td>
                                            <td>{{ $pay->siswa->nama }}</td>
                                            <td>{{ Carbon\Carbon::parse($pay->tanggal_bayar)->format('d-m-Y') }}</td>
                                            <td>{{ ucfirst($pay->bulan_bayar) }}</td>
                                            <td>{{ $pay->tahun_bayar }}</td>
                                            <td>{{  "Rp. " . number_format($pay->jumlah_bayar, 0, '', '.') }}</td>
                                            <td>{{ $pay->status }}</td>

                                        </tr>

                                      @endforeach
                                  </tbody>
                                </table>
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
<script>
    $(document).ready(function() {
        $('#siswaTable').DataTable();
    } );
</script>
@endpush
