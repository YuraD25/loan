<?php

declare(strict_types=1);

namespace App\Domain\Vo;

class AddressVo
{
    public const REGION_PRAGUE = 'PR';
    public const REGION_BRNO = 'BR';
    public const REGION_OSTRAVA = 'OS';

    public const ALLOWED_REGIONS = [
        self::REGION_PRAGUE,
        self::REGION_BRNO,
        self::REGION_OSTRAVA,
    ];

    public function __construct(
        public string $city,
        public string $region,
    ) {
        if (!in_array($region, self::ALLOWED_REGIONS, true)) {
            throw new \InvalidArgumentException('Invalid region provided.');
        }
    }

    public static function fromString(?string $address): ?AddressVo
    {
        if (empty($address)) {
            return null;
        }

        [$city, $region] = explode(',', $address);

        return new self(trim($city), trim($region));
    }
}
