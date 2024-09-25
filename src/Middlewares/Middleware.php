<?php

namespace Bubblegum\Middlewares;

use Bubblegum\Routes\RoutedComponent;

abstract class Middleware extends RoutedComponent
{
    protected RoutedComponent $wrappedComponent;

    public function wrapComponent(RoutedComponent $component): Middleware
    {
        $this->wrappedComponent = $component;
        return $this;
    }

    public function getDestinationName(): string
    {
        return $this->wrappedComponent->getDestinationName();
    }

    public function setDestinationName($destinationName): void
    {
        $this->wrappedComponent->setDestinationName($destinationName);
    }

    protected function handleWrapped(\Bubblegum\Request $request, array $data = []): string
    {
        return $this->wrappedComponent->handle($request, $data);
    }
}