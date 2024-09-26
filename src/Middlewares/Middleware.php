<?php

namespace Bubblegum\Middlewares;

use Bubblegum\Request;
use Bubblegum\Routes\RoutedComponent;

/**
 * Wraps around other routed components and adds more functionality
 */
abstract class Middleware extends RoutedComponent
{
    /**
     * @var RoutedComponent
     */
    protected RoutedComponent $wrappedComponent;

    /**
     * @param RoutedComponent $component
     * @return $this
     */
    public function wrapComponent(RoutedComponent $component): Middleware
    {
        $this->wrappedComponent = $component;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationName(): string
    {
        return $this->wrappedComponent->getDestinationName();
    }

    /**
     * @param $destinationName
     * @return void
     */
    public function setDestinationName($destinationName): void
    {
        $this->wrappedComponent->setDestinationName($destinationName);
    }

    /**
     * Call handle method of wrapped component
     * @param Request $request
     * @param array $data
     * @return string|array
     */
    protected function handleWrapped(Request $request, array $data = []): string|array
    {
        return $this->wrappedComponent->handle($request, $data);
    }
}