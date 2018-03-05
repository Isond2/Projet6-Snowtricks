<?php

namespace STU\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class STUUserBundle extends Bundle
{
	public function getParent()
		  {
		    return 'FOSUserBundle';
		  }
}
