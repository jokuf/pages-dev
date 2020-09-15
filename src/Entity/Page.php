<?php


namespace Jokuf\Site\Entity;


use Jokuf\Site\Gateway\PageGatewayInterface;

class Page
{
    /**
     * @var Page|null
     */
    protected $parent;
    /**
     * @var int
     */
    protected $level;
    /**
     * @var bool
     */
    protected $locked;
    /**
     * @var string
     */
    protected $template;
    /**
     * @var string
     */
    private $content;
    /**
     * @var array
     */
    private $images;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $title;
    /**
     * @var array
     */
    private $tags;

    /**
     * Page constructor.
     * @param Page|null $parent
     * @param string $name
     * @param string $title
     * @param string $content
     * @param array $tags
     * @param int $level
     * @param bool $locked
     * @param string $template
     * @param array $images
     */
    public function __construct(?Page $parent, string $name, string $title, string $content, array $tags, int $level, bool $locked, string $template, array $images)
    {
        $this->parent   = $parent;
        $this->level    = $level;
        $this->locked   = $locked;
        $this->template = $template;
        $this->content  = $content;
        $this->images   = $images;
        $this->name     = $name;
        $this->title    = $title;
        $this->tags     = $tags;
    }

    public function save(PageGatewayInterface $storage): bool
    {

    }

    public function delete(PageGatewayInterface $gateway): bool
    {

    }

}