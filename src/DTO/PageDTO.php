<?php


namespace Jokuf\Site\DTO;


class PageDTO
{
    /**
     * @var int|null
     */
    private $parent;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $content;
    /**
     * @var array
     */
    private $tags;
    /**
     * @var int
     */
    private $level;
    /**
     * @var bool
     */
    private $locked;
    /**
     * @var string
     */
    private $template;
    /**
     * @var array
     */
    private $images;

    /**
     * PageDTO constructor.
     * @param int|null $parent
     * @param string $name
     * @param string $title
     * @param string $content
     * @param array $tags
     * @param int $level
     * @param bool $locked
     * @param string $template
     * @param array $images
     */
    public function __construct(?int $parent, string $name, string $title, string $content, array $tags, int $level, bool $locked, string $template, array $images)
    {
        $this->parent = $parent;
        $this->name = $name;
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
        $this->level = $level;
        $this->locked = $locked;
        $this->template = $template;
        $this->images = $images;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }
}