<?php

namespace App\Postulacion;

use DB;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'Postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion', 'nombre', 'apellido', 'whatsapp', 'correo', 'linkcv',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idpostulacion,
                  nombre,
                  apellido,
                  whatsapp,  
                  correo,
                  linkcv

                FROM postulaciones ORDER BY titulo ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

        public function obtenerPorId($idCliente)
    {
        $sql = "SELECT
                  idpostulacion,
                  nombre,
                  apellido,
                  whatsapp,  
                  correo,
                  linkcv
                FROM postulaciones WHERE idpostulacion = $idPostulacion";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpostulacion = $lstRetorno[0]->idpostulacion;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->whatsapp = $lstRetorno[0]->whatsapp;
            $this->correo = $lstRetorno[0]->correo;
            $this->linkcv = $lstRetorno[0]->linkcv;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            whatsapp='$this->whatsapp',
            correo='$this->correo',
            linkcv='$this->linkcv'
            WHERE idproducto=?";
        $affected = DB::update($sql, [$this->idpostulacion]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM postulaciones WHERE idpostulacion=?";
        $affected = DB::delete($sql, [$this->idpostulacion]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO postulaciones (
                  nombre,
                  apellido,
                  whatsapp,
                  correo,
                  linkcv
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->whatsapp,
            $this->correo,
            $this->linkcv
        ]);
        return $this->idpostulacion = DB::getPdo()->lastInsertId();
    }

  }
