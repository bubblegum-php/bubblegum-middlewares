<?php

if (!function_exists('wrap')) {
    /**
     * Returns object of $wrappedClass wrapped by middlewares
     * @param string $wrappedClass
     * @param mixed ...$middlewaresClasses
     * @return \Bubblegum\Routes\RoutedComponent
     */
    function wrap(string $wrappedClass, ...$middlewaresClasses): \Bubblegum\Routes\RoutedComponent
    {
        return (new Bubblegum\Middlewares\WrappedRoutedComponent())
            ->setWrappedComponent($wrappedClass)
            ->setMiddlewares($middlewaresClasses);
    }
}