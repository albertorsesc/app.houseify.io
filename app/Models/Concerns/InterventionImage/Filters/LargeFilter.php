<?php

namespace App\Models\Concerns\InterventionImage\Filters;

use Intervention\Image\Filters\FilterInterface;

class LargeFilter implements FilterInterface
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
            $image->resize(2200, 1420);

            return $image;
        }
    }
