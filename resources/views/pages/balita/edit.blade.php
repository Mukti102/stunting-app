@extends('layouts.main')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
@endpush
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Balita</h4>
            <h6>Update balita</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Balita</h4>
            <p class="card-text">Update the details of the balita.</p>
        </div>

        <div class="card-body">
            <form action="{{ route('balita.update', $child->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-form.input-text value="{{ $child->nik }}" class="col-sm-6" type="number" label="NIK"
                        name="nik" placeholder="Masukkan NIK 16 Digit" required />
                    <x-form.input-text class="col-sm-6" value="{{ $child->no_kk }}" type="number"
                        label="Nomor Kartu Keluarga (KK)" name="no_kk" placeholder="Masukkan Nomor KK" required />
                    <x-form.input-text class="col-sm-6" value="{{ $child->name }}" label="Nama Balita" name="name"
                        placeholder="Masukkan Nama Balita" required />

                    <!-- Gender -->
                    <div class="col-sm-6 mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option {{ $child->gender == 'laki-laki' ? 'selected' : '' }} value="laki-laki">Laki-laki
                            </option>
                            <option {{ $child->gender == 'perempuan' ? 'selected' : '' }} value="perempuan">Perempuan
                            </option>
                        </select>
                    </div>

                    <!-- Date Born -->
                    <x-form.input-text class="col-sm-6" value="{{ $child->date_born }}" type="date" label="Tanggal Lahir"
                        name="date_born" required />

                    <!-- Nama Orang Tua -->
                    <x-form.input-text class="col-sm-6" value="{{ $child->mother_name }}" label="Nama Ibu"
                        name="mother_name" placeholder="Masukkan Nama Ibu" required />
                    <x-form.input-text class="col-sm-6" value="{{ $child->father_name }}" label="Nama Ayah"
                        name="father_name" placeholder="Masukkan Nama Ayah" required />

                    <!-- Nomor HP -->
                    <x-form.input-text class="col-sm-6" value="{{ $child->parent_phone }}" type="number"
                        label="Nomor HP Orang Tua" name="parent_phone" placeholder="Masukkan Nomor HP" required />

                    <!-- Desa -->
                    <x-form.select class="col-sm-6 mb-3" placeholder="Pilih Desa" label="Pilih Desa" name="desa_id">
                        @foreach ($desa as $item)
                            <option {{ $item->id == $child->desa_id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->nama_desa }}</option>
                        @endforeach
                    </x-form.select>

                    <!-- Alamat -->
                    <div class="col-sm-6 mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" id="address" class="form-control" rows="3" placeholder="Masukkan Alamat" required>{{ $child->address }}</textarea>
                    </div>



                </div>

                <div class="card-footer mt-3">
                    <div class="col-lg-12">
                        <a href="{{ route('balita.index') }}" class="btn btn-cancel">Cancel</a>
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script>
@endpush
