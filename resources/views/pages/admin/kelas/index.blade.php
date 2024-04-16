@extends('layouts.master')
@section('title', 'Data Kelas')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Kelas</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-kelas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kelas</a>
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
                    <table id="kelasTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Kelas</th>
                              <th>Kompetensi Keahlian</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($kelas as $i => $kls)
                            <tr>
                                <td>{{ $i += 1 }}</td>
                                <td>{{ $kls->nama_kelas }}</td>
                                <td>{{ $kls->kompetensi_keahlian }}</td>
                                <td>
                                    <a href="{{ route('data-kelas.edit', $kls->id_kelas) }}" class="btn btn-warning">Edit</a>
                                   <form action="{{ url('data-kelas', $kls->id_kelas) }}" class="d-inline" id="delete{{ $kls->id_kelas }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="deleteData({{ $kls->id_kelas }})">Hapus</button>
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
            $('#kelasTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         function deleteData(id_kelas){
            Swal.fire({
                    title: 'PERINGATAN!',
                    text: "Yakin ingin menghapus kelas? data siswa yang ada dikelas ini pun akan dihapus jika ada.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.value) {
                            $('#delete'+id_kelas).submit();
                        }
                    })
        }
    </script>
@endpush
