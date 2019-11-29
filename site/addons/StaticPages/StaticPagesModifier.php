<?php

namespace Statamic\Addons\StaticPages;

use Statamic\Extend\Modifier;

class StaticPagesModifier extends Modifier
{
    /**
     * Modify a value
     *
     * @param mixed  $value    The value to be modified
     * @param array  $params   Any parameters used in the modifier
     * @param array  $context  Contextual values
     * @return mixed
     */
    public function index($value, $params, $context)
    {
        return $value;
    }
}
