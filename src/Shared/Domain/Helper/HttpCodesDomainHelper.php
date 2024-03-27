<?php

namespace Src\Shared\Domain\Helper;

trait HttpCodesDomainHelper
{
    public function ok():int
    {
        return 200;
    }

    /**
     * @return int
     */
    public function created():int
    {
        return 201;
    }

    /**
     * La solicitud se ha recibido pero aún no se ha actuado sobre ella. No es vinculante, ya que HTTP
     * no permite enviar posteriormente una respuesta asíncrona que indique el resultado de la solicitud.
     * Está pensado para casos en los que otro proceso o servidor gestiona la solicitud,
     * o para el procesamiento por lotes.
     *
     * @return int
     */
    public function accepted():int
    {
        return 202;
    }

    /**
     * Este código de respuesta significa que los metadatos devueltos no son exactamente los mismos que están
     * disponibles en el servidor de origen, sino que se han recogido de una copia local o de terceros. Esto
     * se utiliza sobre todo para réplicas o copias de seguridad de otro recurso. Excepto para ese caso específico,
     * la respuesta 200 OK es preferible a este estado.
     *
     * @return int
     */
    public function nonAuthoritativeInformation():int
    {
        return 203;
    }

    /**
     * No hay contenido que enviar para esta petición, pero las cabeceras pueden ser útiles.
     * El agente de usuario puede actualizar sus cabeceras en caché para este recurso con las nuevas.
     *
     * @return int
     */
    public function noContent():int
    {
        return 204;
    }

    /**
     * @return int
     */
    public function badRequest():int
    {
        return 400;
    }

    /**
     * @return int
     */
    public function unauthorized():int
    {
        return  401;
    }

    public function notFound(): int
    {
        return 404;
    }

    /**
     * @return int
     */
    public function internalError():int
    {
        return 500;
    }


}
