<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Service\PageAssembler;
use Jokuf\Site\Service\Boundary\CreatePagePresenterInterface;
use Jokuf\Site\Core\Entity\Page;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;
use Jokuf\Site\Service\Boundary\CreatePageRequestInterface;
use Jokuf\Site\Service\Model\CreatePageRequestDto;

class CreatePageInteractor implements CreatePageRequestInterface
{
    /**
     * @var Page
     */
    protected $page;
    /**
     * @var PageGatewayInterface
     */
    private $pageGateway;
    /**
     * @var CreatePagePresenterInterface
     */
    private $response;
    /**
     * @var PageAssembler
     */
    private $pageAssembler;

    /**
     * @param PageGatewayInterface $pageGateway
     * @param CreatePagePresenterInterface $response
     */
    public function __construct(
        PageGatewayInterface $pageGateway,
        CreatePagePresenterInterface $response
    ) {
        $this->pageGateway = $pageGateway;
        $this->response = $response;
        $this->pageAssembler = new PageAssembler($pageGateway);
    }

    public function handle(CreatePageRequestDto $pageDTO): void
    {
        // validate the dto

        // if all true - create entity
        $page = $this->pageAssembler->assembleEntity($pageDTO);

        // update the db
        $page->save($this->pageGateway);

        // emit the response
        $this->response->present(
            $this->pageAssembler->assembleResponseDto(
                $page
            )
        );
    }
}