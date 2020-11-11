# MaskPosition	

This object describes the position on faces where a mask should be placed by default.	

## Properties	

- `$point`: _The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”._
- `$x_shift`: _Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position._
- `$y_shift`: _Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position._
- `$scale`: _Mask scaling coefficient. For example, 2.0 means double size._

## Methods	
