<?php

namespace FaimfonyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FaimfonyBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
