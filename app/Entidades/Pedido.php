<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'Pedidos';
    public $timestamps = false;

    protected $fillable = [
      'idpedido', 'fk_idcliente', 'fk_idsucursal', 'fk_idestadopedido', 'fecha', 'total', 'descripcion',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idpedido,
                  fk_idcliente,
                  fk_idsucursal,
                  fk_idestadopedido,
                  fecha,  
                  total,
                  descripcion

                FROM Pedidos ORDER BY fecha DESC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

        public function obtenerPorId($idPedido)
    {
        $sql = "SELECT
                  idpedido,
                  fk_idcliente,
                  fk_idsucursal,
                  fk_idestadopedido,
                  fecha,  
                  total,
                  descripcion

                FROM Pedidos WHERE idpostulacion = $idPedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idestadopedido = $lstRetorno[0]->fk_idestadopedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->total = $lstRetorno[0]->total;
            $this->descripcion = $lstRetorno[0]->descripcion;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE pedidos SET
            fk_idcliente='$this->fk_idcliente',
            fk_idsucursal='$this->fk_idsucursal',
            fk_idestadopedido='$this->fk_idestadopedido',
            fecha='$this->fecha,
            total='$this->total,
            descripcion='$this->descripcion'
            WHERE idPedido=?";
        $affected = DB::update($sql, [$this->idPedido]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
                  fk_idcliente,
                  fk_idsucursal,
                  fk_idestadopedido,
                  fecha,
                  total,
                  descripcion
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente,
            $this->fk_idsucursal,
            $this->fk_idestadopedido,
            $this->fecha,
            $this->total,
            $this->descripcion
        ]);
        return $this->idPedido = DB::getPdo()->lastInsertId();
    }

  }
