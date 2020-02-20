<?php

namespace Chondal\NoticesWorkspace;

use Chondal\NoticesWorkspace\Models\NoticesWorkspace;

class Notice
{
    

    public function alerts()
    {
        $espacio = explode("/", request()->path());
        $alertas = NoticesWorkspace::vigentes($espacio[0])->get();
        return view('NoticesWorkspace::alertas-front', compact(
            'alertas'
        ));;
    }

    public function route()
    {
        return config('notices-workspace.route_name');
    }
    /**
     * Renderiza el atributo selected para un combobox.
     *
     * @param integer $actual
     * @param integer $buscado
     * @return void
     */
    public static function ComboCheck($actual, $buscado)
    {
        if (isset($buscado)) {
            return ($actual == $buscado) ? 'selected' : '' ;
        }
        return '';
    }


}
