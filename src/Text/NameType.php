<?php declare(strict_types=1);

namespace Mediagone\Doctrine\Types\Common\Text;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Mediagone\Types\Common\Text\Name;


final class NameType extends Type
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    public const NAME = 'common_name';
    
    
    
    //========================================================================================================
    // Type implementation
    //========================================================================================================
    
    public function getName() : string
    {
        return self::NAME;
    }
    
    
    /**
     * Gets the SQL declaration snippet for a field of this type.
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) : string
    {
        return $platform->getVarcharTypeDeclarationSQL([
            'length' => Name::MAX_LENGTH,
        ]);
    }
    
    
    /**
     * Adds an SQL comment to typehint the actual Doctrine Type for reverse schema engineering.
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }
    
    
    /**
     * Converts a value from its database representation to its PHP representation of this type.
     *
     * @param string|null $value The value to convert.
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) : ?Name
    {
        return $value !== null ? Name::fromString($value) : null;
    }
    
    
    /**
     * Converts a value from its PHP representation to its database representation of this type.
     *
     * @param Name|null $value The value to convert.
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) : ?string
    {
        return $value ? (string)$value : null;
    }
    
    
    
}
