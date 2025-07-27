@extends('layouts.main')
@section('content')
    <div>
        <x-alert />
        <div class="page-header">
            <div class="page-title">
                <h4>Data Reference Tinggi Badan Usia</h4>
                <h6>Manage your Desa</h6>
            </div>
        </div>


        <x-datatable>

            <table class="table {{ $data->isNotEmpty() ? 'datanew' : '' }}">

                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Median</th>
                        <th>SD</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-capitalize">
                                @if ($item->gender == 'laki-laki')
                                    <span class="badge bg-info">{{ $item->gender }}</span>
                                @else
                                    <span class="badge" style="background: hotpink">{{ $item->gender }}</span>
                                @endif
                            </td>
                            <td>{{ $item->usia_bulan }}</td>
                            <td>{{ $item->median }}</td>
                            <td>{{ $item->sd }}</td>
                            <td>

                                <a data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" class="me-3"
                                    href="#">
                                    <img src="assets/img/icons/edit.svg" alt="img" />
                                </a>
                                <form action="{{ route('reference.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type='submit' style="border: none;background: none" class="confirm-text"
                                        href="javascript:void(0);">
                                        <img src="assets/img/icons/delete.svg" alt="img" />
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </x-datatable>

    </div>


    {{-- modal edit --}}
    @foreach ($data as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Reference Tinggi Badan Usia
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('reference.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body row">
                            <x-form.select name="gender" class="col-sm-6 mb-3" placeholder="Pilih Jenis Kelamin"
                                label="Jenis Kelamin">
                                <option {{ $item->gender == 'laki-laki' ? 'selected' : '' }} value="laki-laki">Laki-Laki
                                </option>
                                <option {{ $item->gender == 'perempuan' ? 'selected' : '' }} value="perempuan">Perempuan
                                </option>
                            </x-form.select>

                            <x-form.input-text class="col-sm-6" value="{{ $item->usia_bulan }}" label="Usia Bulan"
                                name="usia_bulan" type="number" placeholder="Masukkkan Usia Bulan" />

                            <x-form.input-text type="number" class="col-sm-6" value="{{ $item->median }}" label="Median"
                                name="median" placeholder="Masukkan Median" type="number" />
                            <x-form.input-text type="number" class="col-sm-6" value="{{ $item->sd }}" label="SD"
                                name="sd" placeholder="Masukkan SD" />

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
