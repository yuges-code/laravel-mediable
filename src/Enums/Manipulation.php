<?php

namespace Yuges\Mediable\Enums;

enum Manipulation: string
{
    case Resize = 'resize';
    case Width = 'width';
    case Height = 'height';
    case Flip = 'flip';
    case Crop = 'crop';
    case Rotate = 'rotate';
    case Orientate = 'orientate';
    case Blur = 'blur';

    public function parameters(): array
    {
        return match ($this) {
            self::Resize => ['width', 'height', 'constraints'],
            self::Width => ['width', 'constraints'],
            self::Height => ['height', 'constraints'],
            self::Flip => ['flip'],
            self::Crop => ['width', 'height', 'x', 'y'],
            self::Rotate => ['degrees', 'background'],
            self::Orientate => ['orientation'],
            self::Blur => ['blur'],
        };
    }
}
