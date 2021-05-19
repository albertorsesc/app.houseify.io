<?php


namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    protected array $keywords = [
        'jaja',
        'pendejo',
        'chinga',
        'puta',
        'puto',
        'verga',
    ];

    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Spam');
            }
        }
    }
}
