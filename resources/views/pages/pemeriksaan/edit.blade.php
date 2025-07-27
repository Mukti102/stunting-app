@extends('layouts.main')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
@endpush
@section('content')
    <x-alert />
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Pemeriksaan Balita</h4>
            <h6>Update new Pemeriksaan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pemeriksaan.update',$child->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">

                    <!-- Pilih Balita -->
                    <x-form.select class="col-sm-6 mb-3" placeholder="Pilih Balita" label="Pilih Desa" name="child_id">
                        @forelse ($children as $item)
                            <option {{ $item->id == $child->child_id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @empty
                            <option disabled value="">Tidak Ada Data</option>
                        @endforelse
                    </x-form.select>

                    <!-- tanggal -->
                    <x-form.input-text class="col-sm-6" type="date" label="Tanggal Periksa" name="examination_date"
                        placeholder="Tanggal Periksa" value="{{ $child->examination_date }}" required />


                    <!-- usian Bulan -->
                    <x-form.input-text readonly={{ true }} class="col-sm-6" type="number" label="Usia Bulan"
                        name="age_months" value="{{ $child->age_months }}" placeholder="Usia Bulan" />



                    <!-- Berat Badan -->
                    <x-form.input-text class="col-sm-6" type="number" label="Berat Badan" name="weight"
                        placeholder="Masukkan Berat Badan" value="{{ $child->weight }}" required />

                    <!-- Tinggi Badan -->
                    <x-form.input-text class="col-sm-6" type="number" label="Tinggi Badan" name="height"
                        placeholder="Masukkan Tinggi Badan" value="{{ $child->height }}" required />

                    <!-- Linkaran Kepala -->
                    <x-form.input-text class="col-sm-6" type="number" value="{{ $child->head_circumference }}"
                        label="Lingkaran Kepala" name="head_circumference" placeholder="Masukkan Ukuran  Lingkaran Kepala"
                        required />

                    {{-- tindakan --}}
                    <x-form.input-text class="col-sm-6" type="text" label="Tindakan ( Opsional)" name="action"
                        placeholder="Masukkan Tindakan" value="{{ $child->action }}" />

                    <!-- Alamat -->
                    <div class="col-sm-6 mb-3">
                        <label for="notes" class="form-label">Notes ( Opsional )</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Masukkan Catatan">
                            {{ $child->notes }}
                        </textarea>
                    </div>



                </div>

                <div class="card-footer mt-3">
                    <div class="col-lg-12">
                        <a href="{{ route('pemeriksaan.index') }}" class="btn btn-cancel">Cancel</a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const childSelect = document.getElementById('child_id');
            const examDateInput = document.querySelector('input[name="examination_date"]');
            const ageMonthsInput = document.getElementById('age_months');

            function calculateAgeInMonths(birthDate, examDate) {
                const birth = new Date(birthDate);
                const exam = new Date(examDate);
                let months = (exam.getFullYear() - birth.getFullYear()) * 12;
                months += exam.getMonth() - birth.getMonth();

                if (exam.getDate() < birth.getDate()) {
                    months--; // Kurangi jika tanggal belum lewat
                }
                return months >= 0 ? months : 0;
            }

            function updateAgeMonths() {
                const children = @json($children);
                const selectedOption = childSelect.options[childSelect.selectedIndex];
                const balita = children.find((item) => item.id == selectedOption.value);
                const birthDate = balita.date_born;
                const examDate = examDateInput.value;


                if (birthDate && examDate) {
                    const ageMonths = calculateAgeInMonths(birthDate, examDate);
                    ageMonthsInput.value = ageMonths;
                }



            }

            childSelect.addEventListener('change', updateAgeMonths);
            examDateInput.addEventListener('change', updateAgeMonths);
        });
    </script>
@endpush
