<?php

namespace App\Models\Concerns\InterventionImage\Filters;

use Intervention\Image\Filters\FilterInterface;

class SmallFilter implements FilterInterface
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

        public function applyFilter(\Intervention\Image\Image $image)
        {
            if ($image->width() > $image->height()) {
                $image->resize(373.33, 200.61)->interlace()->encode('jpg');
            } else {
                $image->fit(373, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->interlace()->encode('jpg');
            }

            return $image;
        }
    }
