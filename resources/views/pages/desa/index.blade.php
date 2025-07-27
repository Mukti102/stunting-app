@extends('layouts.main')
@section('content')
    <div>
        <x-alert />
        <div class="page-header">
            <div class="page-title">
                <h4>Data Desa</h4>
                <h6>Manage your Desa</h6>
            </div>
            <div class="page-btn">
                <button data-bs-toggle="modal" data-bs-target="#addModal" href="addproduct.html" class="btn btn-added"><img
                        src="assets/img/icons/plus.svg" alt="img" class="me-1" />Tambah</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="assets/img/icons/filter.svg" alt="img" />
                                <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img" /></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="assets/img/icons/pdf.svg" alt="img" /></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="assets/img/icons/excel.svg" alt="img" /></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="assets/img/icons/printer.svg" alt="img" /></a>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="card mb-0" id="filter_inputs">

                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>Nama Desa</th>
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Kode Pos</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>  
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item->nama_desa }}
                                    </td>
                                    <td>{{ $item->kecamatan }}</td>
                                    <td>{{ $item->kabupaten }}</td>
                                    <td>{{ $item->provinsi }}</td>
                                    <td>{{ $item->kode_pos }}</td>
                                    <td>
                                        {{-- <a class="me-3" href="product-details.html">
                                            <img src="assets/img/icons/eye.svg" alt="img" />
                                        </a> --}}
                                        <a data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" class="me-3" href="#">
                                            <img src="assets/img/icons/edit.svg" alt="img" />
                                        </a>
                                        <form action="{{route('desa.destroy', $item->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' style="border: none;background: none"  class="confirm-text" href="javascript:void(0);">
                                                <img src="assets/img/icons/delete.svg" alt="img" />
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center" >Tidak Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('desa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <x-form.input-text class="col-sm-6" label="Nama Desa" name="nama_desa"
                            placeholder="Masukkan Nama Desa" />
                        <x-form.input-text class="col-sm-6" label="Kecamatan" name="kecamatan"
                            placeholder="Masukkan Nama Kecamatan" />
                        <x-form.input-text class="col-sm-6" label="Kabupaten" name="kabupaten"
                            placeholder="Masukkan Nama Kabupaten" />
                        <x-form.input-text class="col-sm-6" label="Provinsi" name="provinsi"
                            placeholder="Masukkan Nama Provinsi" />
                        <x-form.input-text class="col-sm-6" label="Kode Pos" name="kode_pos"
                            placeholder="Masukkan Kode Pos" type="number" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- modal edit --}}
    @foreach ($data as $item)
        <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$item->id}}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{$item->id}}">Edit Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('desa.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body row">
                            <x-form.input-text class="col-sm-6" value="{{$item->nama_desa}}" label="Nama Desa" name="nama_desa"
                                placeholder="Masukkan Nama Desa" />
                            <x-form.input-text class="col-sm-6" value="{{$item->kecamatan}}" label="Kecamatan" name="kecamatan"
                                placeholder="Masukkan Nama Kecamatan" />
                            <x-form.input-text class="col-sm-6" value="{{$item->kabupaten}}" label="Kabupaten" name="kabupaten"
                                placeholder="Masukkan Nama Kabupaten" />
                            <x-form.input-text class="col-sm-6" value="{{$item->provinsi}}" label="Provinsi" name="provinsi"
                                placeholder="Masukkan Nama Provinsi" />
                            <x-form.input-text class="col-sm-6" value="{{$item->kode_pos}}" label="Kode Pos" name="kode_pos"
                                placeholder="Masukkan Kode Pos" type="number" />
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
