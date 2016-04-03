<?php

namespace Enzyme\Freckle;

use InvalidArgumentException;

class Dot
{
    public function get($collection, $path)
    {
        $dotter = $this->resolve($collection);

        if (null === $dotter) {
            $type = gettype($collection);

            throw new InvalidArgumentException(
                "Freckle doesn't know how to process the " .
                "collection of type [{$type}]"
            );
        }

        return $dotter->get($collection, $path);
    }

    protected function resolve($collection)
    {
        if (true === is_array($collection)) {
            return new ArrayDotCollection;
        }

        return null;
    }
}
