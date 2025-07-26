<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $fillable = [
        'nama_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
    ];

    /**
     * Get the full address of the desa.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->nama_desa}, {$this->kecamatan}, {$this->kabupaten}, {$this->provinsi}, {$this->kode_pos}";
    }
}
