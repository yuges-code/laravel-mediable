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
}
