<?php

    namespace App\Models\Concerns\SpamDetection;

class Spam
{

    /**
     * @throws \Exception
     */
    public function detect($body) : bool
    {
        $this->detectInvalidKeywords($body);

        return false;
    }

    /**
     * @param $body
     *
     * @throws \Exception
     */
    public function detectInvalidKeywords($body)
    {
        $invalidKeywords = [
            'yahoo customer support'
        ];

        foreach ($invalidKeywords as $keyword) {
            if (stripos($body, $keyword)) {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }
}
