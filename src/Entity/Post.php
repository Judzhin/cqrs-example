<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @var UuidInterface|null
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="uuid")
     */
    private UuidInterface|null $id = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", name="title", length=100)
     */
    private string|null $title = null;

    /**
     * @var string|null
     * @ORM\Column(type="text", name="content")
     */
    private string|null $content = null;

    const STATE_DRAFT = 10;
    const STATE_PUBLISHED = 20;

    /**
     * @var int|null
     * @ORM\Column(type="integer", name="state")
     */
    private int|null $state = self::STATE_DRAFT;

    /**
     * @return UuidInterface|null
     */
    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface|null $id
     * @return Post
     */
    public function setId(?UuidInterface $id): Post
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Post
     */
    public function setTitle(?string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Post
     */
    public function setContent(?string $content): Post
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getState(): ?int
    {
        return $this->state;
    }

    /**
     * @param int|null $state
     * @return Post
     */
    public function setState(?int $state): Post
    {
        $this->state = $state;
        return $this;
    }

    public function getComments()
    {
        return [];
    }
}
