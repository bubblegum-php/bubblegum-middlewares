<?php

namespace Bubblegum\Middlewares;

class Wrapper
{

    /**
     * @param string $wrappedClass
     * @param ...$middlewaresClasses
     * @return WrappedRoutedComponent
     */
    public static function wrap(string $wrappedClass, ...$middlewaresClasses): WrappedRoutedComponent
    {
        return (new WrappedRoutedComponent())
            ->setWrappedComponent($wrappedClass)
            ->setMiddlewares($middlewaresClasses);
    }
}