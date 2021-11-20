<?php

namespace App\BlogEngine\DomainModel;

use Buttercup\Protects\IdentifiesAggregate;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class PostId
 *
 * @package App\BlogEngine\DomainModel
 */
class PostId implements IdentifiesAggregate
{
    /**
     * PostId constructor.
     * @param UuidInterface $postId
     */
    public function __construct(private UuidInterface $postId)
    {}

    /**
     * Creates an identifier object from a string representation
     * @param string $aPostId
     * @return IdentifiesAggregate
     */
    public static function fromString($aPostId): self
    {
        return new PostId(Uuid::fromString($aPostId));
    }

    /**
     * Returns a string that can be parsed by fromString()
     * @return string
     */
    public function __toString()
    {
        return (string) $this->postId;
    }

    /**
     * Compares the object to another IdentifiesAggregate object. Returns true if both have the same type and value.
     * @param $other
     * @return boolean
     */
    public function equals(IdentifiesAggregate $other)
    {
        return $this->postId->equals($other);
    }

    /**
     * @return PostId
     */
    public static function generate()
    {
        return new PostId(Uuid::uuid4());
    }
}