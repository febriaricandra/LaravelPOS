<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Barang extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'table_barang';

    protected $fillable = [
        'id',
        'nama_barang',
        'harga_jual',
        'harga_beli',
        'stok',
        'keterangan'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'table_barang', 'length' => 10, 'prefix' =>'GM-']);
        });
    }
}
