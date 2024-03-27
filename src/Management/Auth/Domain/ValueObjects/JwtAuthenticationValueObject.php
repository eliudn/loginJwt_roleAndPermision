<?php

namespace Src\Management\Auth\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\MixedValueObjects;

class JwtAuthenticationValueObject extends MixedValueObjects
{
    /**
     * @return array<string,mixed>
     */
    public function handler(): array
    {
        return [
            'iat'=>time(),
            'exp'=>$this->getTime(),
            'iss'=>$this->appUrl(),
            'aud'=>$this->aud(),
            'data'=>$this->value()
        ];
    }
    /**
     * @return int
     */
    private function getTime(): int
    {
        $time = time();
        return $time + (60*60);
    }
    /**
     * @return string
     */
    public function aud(): ?string
    {
        $aud = '';

        if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        }

        if(!empty($_SERVER['HTTP_X_FORWARDER_FOR']))
        {
            $aud = $_SERVER['HTTP_X_FORWARDER_FOR'];
        }

        if(!empty($_SERVER['REMOTE_ADDR']))
        {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .=@$_SERVER['HTTP_USER_AGENT'];
        $aud .=gethostname();

        return sha1($aud ?? null);
    }

    public function jwtKey():string
    {
        return env('JWT_KEY');
    }
    public function jwtEncrypt(): string
    {
        return env('JWT_ENCRYPT');
    }
    private function appUrl():string
    {
        return env('APP_URL');
    }
}
