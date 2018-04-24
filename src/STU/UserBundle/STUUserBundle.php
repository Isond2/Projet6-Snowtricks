<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace STU\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
* STUUserBundle
*/
class STUUserBundle extends Bundle
{
    /**
    * getParent
    *
    * @return FOSUserBundle
    */
    public function getParent()
    {
            return 'FOSUserBundle';
    }
}
