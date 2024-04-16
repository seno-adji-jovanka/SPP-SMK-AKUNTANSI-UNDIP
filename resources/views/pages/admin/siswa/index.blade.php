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
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-siswa.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Siswa</a>
                  <!-- <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div> -->
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive px-3">
                    <table id="siswaTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>NISN</th>
                              <th>NIS</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>No Telp</th>
                              <th>Jenis Kelamin</th>
                              <th>Alamat</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($siswa as $i => $sis)
                            <tr>
                                <td>{{ $i += 1 }}</td>
                                <td>{{ $sis->nisn }}</td>
                                <td>{{ $sis->nis }}</td>
                                <td>{{ $sis->nama }}</td>
                                <td>{{ $sis->kelas->nama_kelas }}</td>
                                <td>{{ $sis->no_telp }}</td>
                                <td>{{ $sis->jenkel }}</td>
                                <td>{{ $sis->alamat }}</td>
                                <td>
                                    <a href="{{ route('data-siswa.edit', $sis->nisn) }}" class="btn btn-warning">Edit</a>
                                   <form action="{{ url('data-siswa', $sis->nisn) }}" class="d-inline" id="delete{{ $sis->nisn }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="deleteData({{ $sis->nisn }})">Hapus</button>
                                   </form>
                                </td>
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
