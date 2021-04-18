<?php

namespace App\Src\Afip\Traits;

trait WSFECREDErrorsTrait
{
    public function hasError($reponse)
    {
        $message = '';

        if (
            array_key_exists('arrayObservacion', $reponse) || 
            array_key_exists('arrayErrores', $reponse) || 
            array_key_exists('arrayErroresFormato', $reponse)
        ) {

            if(array_key_exists('arrayErroresFormato', $reponse)) $message = $reponse['codigoDescripcionString'][0]['descripcion'];

            throw new \Exception($message);
        }

    }
}
