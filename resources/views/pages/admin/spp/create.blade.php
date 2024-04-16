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
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-spp.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('data-spp.store') }}" method="POST">
                        @csrf
                        <!-- <div class="card-header">
                          <h4>Isi Data Berikut</h4>
                        </div> -->
                        <div class="card-body">
                          <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" id="tahun" autocomplete="off" value="{{ old('tahun') }}" required>

                          </div>
                          <div class="form-group">
                            <label>Nominal</label>
                            <input type="text"class="form-control @error('nominal') is-invalid @enderror" name="nominal" id="nominal" autocomplete="off" value="{{ old('nominal') }}" required>
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
