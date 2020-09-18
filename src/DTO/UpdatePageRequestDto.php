<?php


namespace Jokuf\Site\DTO;


class UpdatePageRequestDto
{
    /**
     * @var string|null
     */
    private $slug;
    /**
     * @var string|null
     */
    private $name;
    /**
     * @var string|null
     */
    private $title;
    /**
     * @var string|null
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
     * @var string|null
     */
    private $template;

    public function __construct(
        string $slug=null,
        string $name=null,
        string $title=null,
        string $content=null,
        array $tags=[],
        int $level=0,
        bool $locked=false,
        string $template=null
    ) {
        $this->slug = $slug;
        $this->name = $name;
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
        $this->level = $level;
        $this->locked = $locked;
        $this->template = $template;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
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
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }
}