<?php


namespace Jokuf\Site\DTO;


class PageContentDTO
{
    /**
     * @var int|null
     */
    private $id;

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
     * @var array|null
     */
    private $tags;

    /**
     * @var string|null
     */
    private $language;


    /**
     * PageContentDTO constructor.
     * @param int|null $id
     * @param string|null $name
     * @param string|null $title
     * @param string|null $content
     * @param array|null $tags
     * @param string|null $language
     */
    public function __construct(
        ?int $id=null,
        ?string $name=null,
        ?string $title=null,
        ?string $content=null,
        ?array $tags=[],
        ?string $language=null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
        $this->language = $language;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }
}