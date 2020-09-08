<?php


namespace Jokuf\Site\DTO;


class PageDTO
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int|null
     */
    private $parentPage;
    /**
     * @var PageContentDTO[]
     */
    private $contents;
    /**
     * @var int
     */
    private $level;
    /**
     * @var bool
     */
    private $isLocked;
    /**
     * @var string|null
     */
    private $template;
    /**
     * @var array
     */
    private $images;

    /**
     * PageDTO constructor.
     * @param int|null $id
     * @param int|null $parentPage
     * @param array $contents
     * @param int $level
     * @param bool $isLocked
     * @param string|null $template
     * @param array $images
     */
    public function __construct(?int $id=null, ?int $parentPage=null, array $contents=[], int $level=0, bool $isLocked=false, ?string $template=null, array $images=[]) {
        $this->id = $id;
        $this->parentPage = $parentPage;
        $this->contents = $contents;
        $this->level = $level;
        $this->isLocked = $isLocked;
        $this->template = $template;
        $this->images = $images;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getParentPage(): ?int
    {
        return $this->parentPage;
    }

    /**
     * @return array
     */
    public function getContents(): array
    {
        return $this->contents;
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
        return $this->isLocked;
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
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