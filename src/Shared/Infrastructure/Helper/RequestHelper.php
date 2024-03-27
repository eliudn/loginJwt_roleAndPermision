<?php
namespace Src\Shared\Infrastructure\Helper;

trait RequestHelper
{
     /**
     * @param array $validators
     * @return string
     */
    public function formatErrorsRequest(array $validators): string
    {
        $message= '';
        array_walk(
            $validators,
            static function($value) use (&$message)
            {
                $message .= $value .'|';
            }
        );
        return substr($message, 0, -1);
    }
    /**
     * @return string
     * @param array<int,mixed> $validators
     */
    public function formatErrorsRequest2(array|string $validators):string
   {

        if(is_array($validators))
        {
            $message = http_build_query($validators);
            // dd($message);
            return $message;
        }else
        {

            return explode(",",$validators);
        }
    }

}

