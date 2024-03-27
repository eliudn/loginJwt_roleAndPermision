<?php

namespace Src\Shared\Domain\Exceptions;

use Exception;


abstract class CustomException extends \Exception
{

    public function __construct($message="", $code=0,private  $excep=false)
    {
        parent::__construct($message,$code);
    }
    /**
     * @return array<string,mixed>
     */
    public function toException():array{
        $classTemporally = new \ReflectionClass(get_class($this));
        $class = explode('\\', $classTemporally->getName());

        return  [
            "status"    =>  $this->getCode(),
            "error"     =>  true,
            "class"     =>  end($class),
            "message"   =>  $this->getCustomMessage()
        ];
    }
    private function getCustomMessage(): string|array|bool
    {

        if($this->excep)
        {
            $message ='';
            parse_str($this->message,$message);
            return $message;

        }
        return [$this->message];
    }
}
