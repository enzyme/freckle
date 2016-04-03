<?php

namespace Enzyme\Freckle;

class ArrayDotCollection implements DotCollectionInterface
{
    public function get($collection, $path)
    {
        $parts = explode('.', $path);
        $top = count($parts) - 1;
        $index = 0;

        foreach ($array as $key => $value) {
            // If we have only one path item left and this array key matches
            // it, let's immediately return its value.
            if ($key === $parts[0] && $index === $top) {
                return $value;
            }

            // If this array key matches the path item we're currently on,
            // let's dig in deeper and hope to find the full path.
            if ($key === $parts[0]) {
                // The next iteration will continue on the next available path
                // item chain. Eg: if we were on 'foo.bar.xzy', we'll be passing
                // in 'bar.xyz' to the recursive call.
                $new_path = array_slice($parts, 1);
                $new_path = implode('.', $new_path);

                return $this->get($value, $new_path);
            }

            // If we're currently sitting on a numerical key, let's dig in
            // deeper in hopes to find some string keys to work with.
            if (true === is_int($key)) {
                // Keep our current path chain.
                $new_path = implode('.', $parts);
                $hit = $this->get($value, $new_path);

                // If we found a match futher down the rabbit hole, let's
                // return that value here, otherwise let's do another iteration.
                if (null !== $hit) {
                    return $hit;
                }
            }
        }

        return null;
    }
}
