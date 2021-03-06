<?php
declare(strict_types=1);

namespace Kryus\Binary\DataType;

use Kryus\Binary\Enum\Endianness;

class UnsignedDword extends BinaryValue
{
    use UnsignedValueTrait;

    /**
     * @param string $value
     * @param int $endianness
     * @throws \Exception
     */
    public function __construct(string $value, int $endianness = Endianness::ENDIANNESS_LITTLE_ENDIAN)
    {
        $byteCount = strlen($value);
        if ($byteCount !== 4) {
            throw new \Exception("Invalid byte count of {$byteCount} for value of type Unsigned Dword.");
        }

        parent::__construct($value, $endianness, false);
    }

    /**
     * @return Dword
     * @throws \Exception
     */
    public function asSigned(): Dword
    {
        return new Dword($this->__toString(), $this->getEndianness());
    }

    /**
     * @return Dword
     * @throws \Exception
     */
    public function toSigned(): Dword
    {
        $value = $this->asSigned();

        if ($value->toInt() < 0) {
            throw new \Exception("Value too big for type Dword.");
        }

        return $value;
    }

    /**
     * @return UnsignedWord
     * @throws \Exception
     */
    public function getHighWord(): UnsignedWord
    {
        $value = $this->__toString();
        $endianness = $this->getEndianness();

        return new UnsignedWord(substr($value, $endianness === Endianness::ENDIANNESS_LITTLE_ENDIAN ? 2 : 0, 2), $endianness);
    }

    /**
     * @return UnsignedWord
     * @throws \Exception
     */
    public function getLowWord(): UnsignedWord
    {
        $value = $this->__toString();
        $endianness = $this->getEndianness();

        return new UnsignedWord(substr($value, $endianness === Endianness::ENDIANNESS_LITTLE_ENDIAN ? 0 : 2, 2), $endianness);
    }
}