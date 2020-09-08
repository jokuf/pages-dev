<?php


namespace Jokuf\Site\Entity;


class PageContent
{
    /** @var int|null */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string */
    protected $title;
    /** @var string */
    protected $content;
    /** @var [] */
    protected $tags;
    /** @var string */
    protected $language;
    /** @var Page */
    protected $page;

    /**
     * PageContent constructor.
     * @param int|null $id
     * @param string $name
     * @param string $title
     * @param string $content
     * @param $tags
     * @param string $language
     */
    public function __construct(?int $id, string $name, string $title, string $content, $tags, string $language)
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
        $this->language = $language;
    }

    public function setId(int $id) {
        if (null !== $this->id) {
            throw new \UnexpectedValueException('Id already set');
        }

        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }
}