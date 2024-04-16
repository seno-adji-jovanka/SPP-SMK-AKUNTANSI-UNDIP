@extends('layouts.master')
@section('title', 'Riwayat Pembayaran')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Riwayat  Pembayaran</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-body p-0">
                  <div class="table-responsive p-3">
                    <table id="siswaTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <!-- <th>Petugas</th> -->
                              <th>NISN</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>Jenis kelamin</th>
                              <th>Tanggal Bayar</th>
                              <th>SPP Bulan</th>
                              <th>SPP Tahun</th>
                              <th>Nominal</th>
                              <th>Status</th>

                              <!-- <th>Action</th> -->
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($pembayaran as $i => $spp)
                            <tr>
                                <td>{{ $i += 1 }}</td>
                                <!-- <td>{{ $spp->user->name }}</td> -->
                                <td>{{ $spp->nisn }}</td>
                                <td>{{ $spp->siswa->nama }}</td>
                                <td>{{ $spp->siswa->kelas->nama_kelas }}</td>
                                <td>{{ $spp->siswa->jenkel }}
                                <td>{{ Carbon\Carbon::parse($spp->tanggal_bayar)->format('d-m-Y') }}</td>
                                <td>{{ ucfirst($spp->bulan_bayar) }}</td>
                                <td>{{ $spp->tahun_bayar }}</td>
                                <td>{{  "Rp. " . number_format($spp->jumlah_bayar, 0, '', '.') }}</td>
                                <td>{{ $spp->status }}</td>
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
    <!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('#siswaTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         function deleteData(nisn){
            Swal.fire({
                    title: 'PERINGATAN!',
                    text: "Yakin ingin menghapus data siswa? data pembayaran atas nama siswa ini pun akan dihapus jika ada.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.value) {
                            $('#delete'+nisn).submit();
                        }
                    })
        }
    </script>
@endpush
