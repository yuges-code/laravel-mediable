<?php

namespace Yuges\Mediable\Manipulations;

use Yuges\Image\Enums\Orientation;
use Yuges\Image\Enums\FlipDirection;
use Yuges\Image\Enums\ResizeConstraint;
use Yuges\Mediable\Enums\Manipulation as ManipulationEnum;

class Manipulation
{
    public function __construct(
        public ManipulationEnum $method,
        public array $parameters = []
    ) {
        $this->parameters = $this->transformParameters($this->method, $this->parameters);
    }

    public static function create(ManipulationEnum $method, array $parameters = []): self
    {
        return new static($method, $parameters);
    }

    public function merge(array $parameters = []): self
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
    }

    public function transformParameters(ManipulationEnum $method, array $parameters = []): array
    {
        $parameters = $this->namingParameters($method, $parameters);

        $options = [
            [
                'methods' => [ManipulationEnum::Resize, ManipulationEnum::Width, ManipulationEnum::Height],
                'transforms' => [
                    'constraints' => ResizeConstraint::class,
                ],
            ],
            [
                'methods' => [ManipulationEnum::Flip],
                'transforms' => [
                    'flip' => FlipDirection::class,
                ],
            ],
            [
                'methods' => [ManipulationEnum::Orientate],
                'transforms' => [
                    'orientation' => Orientation::class,
                ],
            ],
        ];

        foreach ($options as $option) {
            if (! in_array($method, $option['methods'], true)) {
                continue;
            }

            foreach ($option['transforms'] as $key => $transform) {
                if (isset($parameters[$key]) && ! $parameters[$key] instanceof $transform) {
                    $parameters[$key] = $transform::from($parameters[$key]);
                }
            }

            break;
        }

        return $parameters;
    }

    public function namingParameters(ManipulationEnum $method, array $parameters = []): array
    {
        $named = [];
        $names = array_slice($method->parameters(), 0, count($parameters));

        foreach ($names as $key => $name) {
            $named[$name] = $parameters[$name] ?? $parameters[$key];
        }

        return $named;
    }
}
