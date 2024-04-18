<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_productos extends Model
{
    protected $table = 'Pedido_productos';
    public $timestamps = false;

    protected $fillable = [
      'idpedidoproducto', 'fk_idproducto', 'fk_idpedido',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idpedidoproducto,
                  fk_idproducto,
                  fk_idpedido

                FROM Pedido_productos ORDER BY idpedidoproducto ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

        public function obtenerPorId($idpedidoproducto)
    {
        $sql = "SELECT
                  idpedidoproducto,
                  fk_idproducto,
                  fk_idpedido

                FROM Pedidos WHERE idpostulacion = $idpedidoproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedidoproducto = $lstRetorno[0]->idpedidoproducto;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE pedidos SET
            fk_idproducto='$this->fk_idproducto',
            fk_idpedido='$this->fk_idpedido',
            
            WHERE idpedidoproducto=?";
        $affected = DB::update($sql, [$this->idpedidoproducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM Pedido_productos WHERE idpedidoproducto=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO Pedido_productos (
                  fk_idproducto,
                  fk_idpedido
            ) VALUES (?, ?);";

        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idpedido
        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }

  }
