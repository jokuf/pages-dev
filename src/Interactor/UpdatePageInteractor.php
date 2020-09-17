<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Assembler\PageAssembler;
use Jokuf\Site\Boundary\UpdatePageRequestInterface;
use Jokuf\Site\Boundary\UpdatePageResponseInterface;
use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\DTO\CreatePageResponseDto;
use Jokuf\Site\DTO\UpdatePageRequestDto;
use Jokuf\Site\Entity\Page;
use Jokuf\Site\Gateway\PageGatewayInterface;

class UpdatePageInteractor implements UpdatePageRequestInterface
{
    /**
     * @var PageGatewayInterface
     */
    private $gateway;
    /**
     * @var UpdatePageResponseInterface
     */
    private $response;
    /**
     * @var PageAssembler
     */
    private $assembler;

    public function __construct(PageGatewayInterface $gateway, UpdatePageResponseInterface $response)
    {
        $this->assembler = new PageAssembler($gateway);
        $this->gateway = $gateway;
        $this->response = $response;
    }

    public function handle(UpdatePageRequestDto $request): void
    {
        if (null === $request->getSlug()) {
            throw new \InvalidArgumentException();
        }

        $data = $this->gateway->getBySlug($request->getSlug());
        if (null === $data) {
            throw new \DomainException('Page not found.');
        }

        $page = new Page(
            $data->getSlug(),
            null,
            $data->getName(),
            $data->getTitle(),
            $data->getContent(),
            $data->getTags(),
            $data->getLevel(),
            $data->isLocked(),
            $data->getTemplate()
        );

        if ($name = $request->getName()) {
            $page->updateName($name);
        }

        if ($title = $request->getTitle()) {
            $page->updateTitle($title);
        }

        if ($name = $request->getName()) {
            $page->updateName($name);
        }

        $page->save($this->gateway);

        $this->response->present(
            new CreatePageResponseDto(
                $page->getSlug(),
                $page->getName(),
                $page->getTitle(),
                $page->getContent(),
                $page->getTags(),
                $page->getLevel(),
                $page->isLocked(),
                $page->getTemplate()
            )
        );
    }
}