<?php

namespace PenD\Docker\Application\Transport;

class TransporterFactory
{
    private $transporters;

    /**
     * TransporterFactory constructor.
     * @param $transporters
     */
    public function __construct($transporters = null)
    {
        $this->transporters = $transporters ?? [
            'ECK' => new EckTransporter(),
            'GLS' => new GlsTransporter()
        ];
    }


    public function get($code):?TransporterInterface{
        if(!isset($this->transporters[$code])){
            return null;
        }
        return $this->transporters[$code];
    }
}