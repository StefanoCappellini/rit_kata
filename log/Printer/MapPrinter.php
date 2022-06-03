<?php

namespace Log\Printer;

use Log\Map;

interface MapPrinter
{
    public function print(Map $map);
}