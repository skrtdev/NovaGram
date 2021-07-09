<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object describes the position on faces where a mask should be placed by default.
*/
class MaskPosition extends Type{
    
    /** @var string The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”. */
    public string $point;

    /** @var float Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position. */
    public float $x_shift;

    /** @var float Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position. */
    public float $y_shift;

    /** @var float Mask scaling coefficient. For example, 2.0 means double size. */
    public float $scale;

    public function __construct(array $array, Bot $Bot = null){
        $this->point = $array['point'];
        $this->x_shift = $array['x_shift'];
        $this->y_shift = $array['y_shift'];
        $this->scale = $array['scale'];
        parent::__construct($array, $Bot);
    }
    
    
}
