<?php


namespace Jokuf\Site\Entity;


class Page
{
    /** @var int */
    protected $id;
    /** @var int|null */
    protected $parent;
    /** @var PageContentCollection */
    protected $contentCollection;
    /** @var int */
    protected $level;
    /** @var bool */
    protected $locked;
    /** @var string */
    protected $template;

    /**
     * Page constructor.
     * @param int $id
     * @param int|null $parent
     * @param PageContent[] $contents
     * @param int $level
     * @param bool $locked
     * @param string $template
     */
    public function __construct(?int $id, ?int $parent, array $contents, int $level, bool $locked, string $template)
    {
        if (null !== $id) {
            $this->setId($id);
        }

        if (null !== $parent && 1 > $parent) {
            throw new \DomainException('Parent page id should be positive integer or null');
        }

        $this->id = $id;
        $this->parent = $parent;
        $this->contentCollection = new PageContentCollection(... $contents);
        $this->level = $level;
        $this->locked = $locked;
        $this->template = $template;
    }

    public function setId(int $id) {
        if (null !== $this->id) {
            throw new \DomainException('Id already set');
        }

        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Page|null
     */
    public function getParent(): ?int
    {
        return $this->parent;
    }

    /**
     * @return PageContentCollection
     */
    public function getContent(): PageContentCollection
    {
        return $this->contentCollection;
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

    public function getImages()
    {
        return [];
    }
}