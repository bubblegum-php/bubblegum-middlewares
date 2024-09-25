<?php

namespace Bubblegum\Middlewares;


use Bubblegum\Request;
use Bubblegum\Routes\RoutedComponent;

class WrappedRoutedComponent extends RoutedComponent
{

    protected string $destinationName;

    public function setDestinationName($destinationName): void
    {
        $this->destinationName = $destinationName;
    }

    public function getDestinationName(): string
    {
        return $this->destinationName;
    }

    /**
     * @var Middleware[]
     */
    protected array $middlewares = [];

    /**
     * @var string
     */
    protected string $wrappedComponentClass;

    /**
     * @param array $middlewares
     * @return WrappedRoutedComponent
     */
    public function setMiddlewares(array $middlewares): WrappedRoutedComponent
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    /**
     * @param string $wrappedComponentClass
     * @return WrappedRoutedComponent
     */
    public function setWrappedComponent(string $wrappedComponentClass): WrappedRoutedComponent
    {
        $this->wrappedComponentClass = $wrappedComponentClass;
        return $this;
    }

    /**
     * @param Request $request
     * @param array $data
     * @return string
     */
    public function handle(Request $request, array $data = []): string
    {
        $component = $this->wrappedComponentClass;
        foreach ($this->middlewares as $middlewareClass) {
            $component = (new $middlewareClass($this->getDestinationName()))->wrapComponent($component);
        }
        return $component->handle($request, $data);
    }
}