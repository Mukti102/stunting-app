@extends('layouts.main')
@section('content')
    <div>
        <x-alert />
        <div class="page-header">
            <div class="page-title">
                <h4>Data Pemeriksaan Balita</h4>
                <h6>Manage Data Pemeriksaan Balita</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('pemeriksaan.create') }}" class="btn btn-added"><img src="assets/img/icons/plus.svg"
                        alt="img" class="me-1" />Tambah</a>
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
                    {{-- <div class="wordset">
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
                    </div> --}}
                </div>


                <div class="card mb-0" id="filter_inputs">

                </div>

                <div class="table-responsive">
                    <table class="table dataNew">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Kelamin</th>
                                <th>Usia Bulan</th>
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                                <th>Status</th>
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
                                        {{ $item->child->nik }}
                                    </td>
                                    <td>{{ $item->child->name }}</td>
                                    <td class="text-capitalize">
                                        @if ($item->child->gender == 'laki-laki')
                                            <span class="badge bg-info">
                                                {{ $item->child->gender }}
                                            </span>
                                        @else
                                            <span class="badge" style="background-color: hotpink">
                                                {{ $item->child->gender }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $item->age_months }}</td>
                                    <td>{{ $item->height }}</td>
                                    <td>{{ $item->weight }}</td>
                                    <td>
                                        @if ($item->status_stunting == 'severely_stunting')
                                            <span class="badge bg-black">Stunting Berat</span>
                                        @elseif($item->status_stunting == 'stunting')
                                            <span class="badge bg-danger">Stunting</span>
                                        @elseif($item->status_stunting == 'normal')
                                            <span class="badge bg-success">Normal</span>
                                        @else
                                            <span class="badge bg-warning">Berisiko</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pemeriksaan.show', $item->id) }}" class="me-3"
                                            href="product-details.html">
                                            <img src="assets/img/icons/eye.svg" alt="img" />
                                        </a>
                                        <a class="me-3" href="{{ route('pemeriksaan.edit', $item->id) }}">
                                            <img src="assets/img/icons/edit.svg" alt="img" />
                                        </a>
                                        <form action="{{ route('pemeriksaan.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' style="border: none;background: none"
                                                class="confirm-text" href="javascript:void(0);">
                                                <img src="assets/img/icons/delete.svg" alt="img" />
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center">Tidak Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
