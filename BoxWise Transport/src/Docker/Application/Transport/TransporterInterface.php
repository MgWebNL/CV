<?php

namespace PenD\Docker\Application\Transport;

interface TransporterInterface
{
    public function createLabel($data);
}