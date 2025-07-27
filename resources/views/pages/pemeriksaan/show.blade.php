@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Detail {{ $child->child->name }}</h4>
                <h6>Full details of a pemeriksaan balita</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Detail Pemeriksaan  {{ $child->child->name }}
                </h5>
                <p class="card-text">
                    Detail Tentang Pemeriksaan Pada Balita {{ $child->name }}
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
                                            <h6>{{ $child->child->nik }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Nama lengkap</h4>
                                            <h6>{{ $child->child->name }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Jenis Kelamin</h4>
                                            @if ($child->child->gender == 'laki-laki')
                                                <h6 class=" ">{{ $child->child->gender }}</h6>
                                            @else
                                                <h6 class="" style="background:hotpink">{{ $child->child->gender }}
                                                </h6>
                                            @endif
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Usia Bulan</h4>
                                            <h6 class="">{{ $child->age_months }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Berat Badan</h4>
                                            <h6 class="">{{ $child->weight }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Tinggi Badan</h4>
                                            <h6 class="">{{ $child->height }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Lingkaran Kepala</h4>
                                            <h6 class="">{{ $child->head_circumference }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">ZScore Tbu</h4>
                                            <h6 class="">{{ $child->zscore_tbu }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Status</h4>
                                            @if ($child->status_stunting == 'severely_stunting')
                                                <h6 class="">Stunting Berat</h6>
                                            @elseif ($child->status_stunting == 'stunting')
                                                <h6 class="">Stunting</h6>
                                            @elseif ($child->status_stunting == 'normal')
                                                <h6 class="">Normal</h6>
                                            @else
                                                <h6 class="">Berisiko</h6>
                                            @endif
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Tindakan</h4>
                                            <h6 class="">{{ $child->actions }}</h6>
                                        </li>
                                        <li>
                                            <h4 style="font-weight: 600">Catatan</h4>
                                            <h6 class="">{{ $child->notes }}</h6>
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
