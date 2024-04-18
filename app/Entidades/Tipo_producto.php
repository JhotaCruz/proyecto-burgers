<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Tipo_producto extends Model
{
    protected $table = 'Tipo_productos';
    public $timestamps = false;

    protected $fillable = [
        'idtipoproducto', 'nombre',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idtipoproducto,
                  nombre,
                  
                FROM Tipo_productos ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

        public function obtenerPorId($idtipoproducto)
    {
        $sql = "SELECT
                  idtipoproducto,
                  nombre
                FROM Tipo_productos WHERE idtipoproducto = $idtipoproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idtipoproducto = $lstRetorno[0]->idtipoproducto;
            $this->nombre = $lstRetorno[0]->nombre;
           
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE Tipo_producto SET
            nombre='$this->nombre',
          
            WHERE idtipoproducto=?";
        $affected = DB::update($sql, [$this->idtipoproducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM Tipo_producto WHERE idtipoproducto=?";
        $affected = DB::delete($sql, [$this->idtipoproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO Tipo_producto (
                  nombre
                 
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre
        ]);
        return $this->idtipoproducto = DB::getPdo()->lastInsertId();
    }

  }
