@extends('layouts.main')
@section('content')
    <div>
        <x-alert />
        <div class="page-header">
            <div class="page-title">
                <h4>Data Balita</h4>
                <h6>Manage Balita</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('balita.create') }}" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                        class="me-1" />Tambah</a>
            </div>
        </div>

        <x-datatable>

            <table class="table {{ $data->isNotEmpty() ? 'datanew' : '' }}">

                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Kelamin</th>
                        <th>Nama Ibu</th>
                        <th>Nama Ayah</th>
                        <th>Phone OrangTua</th>
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
                                {{ $item->nik }}
                            </td>
                            <td>{{ $item->name }}</td>
                            <td class="text-capitalize">
                                @if ($item->gender == 'laki-laki')
                                    <span class="badge bg-info">
                                        {{ $item->gender }}
                                    </span>
                                @else
                                    <span class="badge" style="background-color: hotpink">
                                        {{ $item->gender }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $item->mother_name }}</td>
                            <td>{{ $item->father_name }}</td>
                            <td>{{ $item->parent_phone }}</td>
                            <td>
                                <a href="{{ route('balita.show', $item->id) }}" class="me-3" href="product-details.html">
                                    <img src="assets/img/icons/eye.svg" alt="img" />
                                </a>
                                <a class="me-3" href="{{ route('balita.edit', $item->id) }}">
                                    <img src="assets/img/icons/edit.svg" alt="img" />
                                </a>
                                <form action="{{ route('balita.destroy', $item->id) }}" method="POST" class="d-inline">
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
@endsection
