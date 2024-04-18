<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carritos extends Model
{
    protected $table = 'Carrito';
    public $timestamps = false;

    protected $fillable = [
        'idcarrito', 'fk_idcliente', 'fk_idproducto', 'cantidad',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idcarrito,
                  fk_idcliente,
                  fk_idproducto,
                  cantidad

                FROM carritos ORDER BY cantidad ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

        public function obtenerPorId($idcarrito)
    {
        $sql = "SELECT
                  idcarrito,
                  fk_idcliente,
                  fk_idproducto,
                  cantidad
                FROM carritos WHERE idcarrito = $idcarrito";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->cantidad = $lstRetorno[0]->cantidad;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE Carritos SET
            fk_idcliente='$this->fk_idcliente',
            fk_idproducto='$this->fk_idproducto',
            cantidad='$this->cantidad,
            
            WHERE idcarrito=?";
        $affected = DB::update($sql, [$this->idcarrito]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM carritos WHERE idcarrito=?";
        $affected = DB::delete($sql, [$this->idcarrito]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO carritos (
                  fk_idcliente,
                  fk_idproducto,
                  cantidad
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente,
            $this->fk_idproducto,
            $this->cantidad,
            
        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }

  }
