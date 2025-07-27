@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Detail {{ $child->name }}</h4>
                <h6>Full details of a balita</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $child->name }}
                </h5>
                <p class="card-text">
                    Detail Tentang {{ $child->name }}
                </p>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="productdetails">
                                    <ul class="product-bar">
                                        <li>
                                            <h4 style="font-weight: 600">NIK</h4>
                                            <h6>{{ $child->nik }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Nomor KK</h4>
                                            <h6>{{ $child->no_kk }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Nama Lengkap</h4>
                                            <h6>{{ $child->name }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Jenis Kelamin</h4>
                                            <h6 class="text-capitalize">
                                                @if ($child->gender == 'laki-laki')
                                                    <span class="badge bg-info">{{ $child->gender }}</span>
                                                @else
                                                    <span class="badge"
                                                        style="background: hotpink">{{ $child->gender }}</span>
                                                @endif
                                            </h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Tanggal Lahir</h4>
                                            <h6>{{ \carbon\Carbon::parse($child->date_born)->translatedFormat('d F Y') }}
                                            </h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Nama Ibu</h4>
                                            <h6>{{ $child->mother_name }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Nama Ayah</h4>
                                            <h6>{{ $child->father_name }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Nomor Telephone Ortu</h4>
                                            <h6>{{ $child->parent_phone }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Desa</h4>
                                            <h6>{{ $child->desa->nama_desa }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Alamat</h4>
                                            <h6>{{ $child->address }}</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
