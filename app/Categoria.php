<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table      = 'categoria';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'id_categoria',
        'nombre',
        'descripcion',
        'estado',
    ];

    public function productos_categoria()
    {
        return $this->hasMany(ProductoCategoria::class, 'id_categoria');
    }

    public function productos()
    {
        $productos = [];
        foreach ($this->productos_categoria as $item) {
            $productos[] = $item->producto;
        }
        return $productos;
    }
}
