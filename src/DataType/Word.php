<?php
declare(strict_types=1);

namespace Kryus\Binary\DataType;

class Word extends BinaryValue
{
    /**
     * @param string $value
     * @param int $endianness
     * @throws \Exception
     */
    public function __construct(string $value, int $endianness = BinaryValue::ENDIANNESS_LITTLE_ENDIAN)
    {
        $byteCount = strlen($value);
        if ($byteCount !== 2) {
            throw new \Exception("Invalid byte count of {$byteCount} for value of type Word.");
        }

        parent::__construct($value, $endianness);
    }
}