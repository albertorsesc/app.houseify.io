<?php

namespace App\Models\Concerns\InterventionImage\Filters;

use Intervention\Image\Filters\FilterInterface;

class MediumFilter implements FilterInterface
    {
        /**
         * Default size of filter effects
         */
        const DEFAULT_SIZE = 10;

        /**
         * Size of filter effects
         *
         * @var integer
         */
        private $size;

        /**
         * Creates new instance of filter
         *
         * @param integer $size
         */
        public function __construct($size = null)
        {
            $this->size = is_numeric($size) ? intval($size) : self::DEFAULT_SIZE;
        }

        public function applyFilter(\Intervention\Image\Image $image) : \Intervention\Image\Image
        {
            if ($image->width() > $image->height()) {
                $image->resize(740.66, 398)->interlace()->encode('jpg');
            } else {
                $image->resize(740.66, 398, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upSize();
                })->resizeCanvas(741, 398)->interlace()->encode('jpg');
            }

             return $image;
        }
    }
