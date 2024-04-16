@extends('layouts.master')
@section('title', 'Data SPP')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data SPP</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-spp.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah SPP</a>
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
                    <table id="sppTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Tahun</th>
                              <th>Nominal</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($spp as $i => $spp)
                            <tr>
                                <td>{{ $i += 1 }}</td>
                                <td>{{ $spp->tahun }}</td>
                                <td>Rp. {{ number_format($spp->nominal, 0, '', '.') }}</td>
                                <td>
                                    <a href="{{ route('data-spp.edit', $spp->id_spp) }}" class="btn btn-warning">Edit</a>
                                   <form action="{{ url('data-spp', $spp->id_spp) }}" class="d-inline" id="delete{{ $spp->id_spp }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="deleteData({{ $spp->id_spp }})">Hapus</button>
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
            $('#sppTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         function deleteData(id_spp){
            Swal.fire({
                    title: 'PERINGATAN!',
                    text: "Yakin ingin menghapus data SPP? data pembayaran dan data siswa dengan SPP ini pun akan dihapus jika ada.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.value) {
                            $('#delete'+id_spp).submit();
                        }
                    })
        }
    </script>
@endpush
