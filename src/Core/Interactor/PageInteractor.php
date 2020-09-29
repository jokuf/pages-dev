<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Core\Entity\Page;
use Jokuf\Site\Service\Boundary\PageBoundaryInterface;
use Jokuf\Site\Service\Boundary\PagePresenterInterface;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;
use Jokuf\Site\Service\Model\CreatePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageResponseDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Service\Model\UpdatePageRequestDto;
use Jokuf\Site\Service\PageAssembler;

class PageInteractor implements PageBoundaryInterface
{
    /**
     * @var PageGatewayInterface
     */
    private $gateway;
    /**
     * @var PagePresenterInterface
     */
    private $presenter;
    /**
     * @var PageAssembler
     */
    private $pageAssembler;


    /**
     * PageInteractor constructor.
     * @param PageGatewayInterface $gateway
     * @param PagePresenterInterface $presenter
     */
    public function __construct(PageGatewayInterface $gateway, PagePresenterInterface $presenter)
    {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
        $this->pageAssembler = new PageAssembler($gateway);

    }

    public function create(CreatePageRequestDto $request): void
    {
        // validate the dto

        // if all true - create entity
        $page = $this->pageAssembler->assembleEntity($request);

        // update the db
        $page->save($this->gateway);

        // emit the response
        $this->presenter->presentSinglePage(
            $this->pageAssembler->assembleResponseDto(
                $page
            )
        );
    }

    public function update(UpdatePageRequestDto $request): void
    {
        $data = null;
        if (null === $request->getSlug()) throw new \InvalidArgumentException();


        if (false !== ($parsedUrl = parse_url($request->getSlug()))) {
            $data = $this->gateway->getBySlug($parsedUrl['path']);
        }

        if (null === $data) throw new \DomainException('Page not found.');

        $page = new Page($data);

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

        $data = Page::export($page);

        $this->presenter->presentSinglePage(
            new ConcretePageResponseDto(
                $data->getSlug(),
                $data->getName(),
                $data->getTitle(),
                $data->getContent(),
                $data->getTags(),
                $data->getLevel(),
                $data->isLocked(),
                $data->getTemplate()
            )
        );
    }

    public function delete(DeletePageRequestDto $request): void
    {
        $response = new DeletePageResponseDto(false);

        if (1 === preg_match('#^[a-z0-9-/]+$#', $request->getSlug())) {
            $data = $this->gateway->getBySlug($request->getSlug());

            if (null !== $data) {
                $page = new Page($data);

                $response = new DeletePageResponseDto(
                    $page->delete(
                        $this->gateway
                    )
                );
            }
        }

        $this->presenter->presentDeletedPage($response);
    }

    public function getBySlug(GetPageRequestDto $request): void
    {
        if (false !== ($parsedSlug = parse_url($request->getSlug()))) {
            $path = $parsedSlug['path'];
            if ($pageData = $this->gateway->getBySlug($path)) {
                $this->presenter->presentSinglePage(
                    new ConcretePageResponseDto(
                        $pageData->getSlug(),
                        $pageData->getName(),
                        $pageData->getTitle(),
                        $pageData->getContent(),
                        $pageData->getTags(),
                        $pageData->getLevel(),
                        $pageData->isLocked(),
                        $pageData->getTemplate()
                    )
                );

                return;
            }
        }

        throw new \InvalidArgumentException("Page not found");
    }
}