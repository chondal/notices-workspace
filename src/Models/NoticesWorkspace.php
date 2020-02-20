<?php

namespace Chondal\NoticesWorkspace\Models;

use Carbon\Carbon;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticesWorkspace extends Model
{
    use SoftDeletes;


    protected $guarded = [];


    /**
    * Devuelve el icono del estado de la alerta
    * @author Jonathan Pradi
    * @param  \Illuminate\Http\Request  $request
    * @param  
    * @return \Illuminate\Http\Response
    */
    public function estado()
    {
        $hoy = Carbon::now();

        if ( $hoy >= $this->desde && $this->hasta >= $hoy ) {
            return new HtmlString('<i class="icon-checkmark text-success"></i>');
        }
        else {
            return new HtmlString('<i class="icon-cross2 text-danger"></i>');
        }
    }


    // GETTES Y SETTERS

    public function setDesdeAttribute($desde)
    {
        $this->attributes['desde'] = $desde 
            ? Carbon::parse($desde) 
            : null;

    }
    public function setHastaAttribute($hasta)
    {
        $this->attributes['hasta'] = $hasta 
            ? Carbon::parse($hasta) 
            : null;

    }
    public function getDesdeAttribute($value)
    {
        return Carbon::parse($value);
    }
    public function getHastaAttribute($value)
    {
        return Carbon::parse($value);
    }


    // SCOPES
    public function scopeVigentes($query, $seccion)
    {
        // FIXME: no trae el ultimo dia... una vez que pasan las 00 horas no lo trae, ver como mejorar
        $hoy = Carbon::now();
        return $query->where('desde','<=',$hoy)
                    ->where('hasta','>=',$hoy)
                    ->where('seccion',$seccion);

    }





}
