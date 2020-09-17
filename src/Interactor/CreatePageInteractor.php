<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Assembler\PageAssembler;
use Jokuf\Site\Boundary\CreatePagePresenterInterface;
use Jokuf\Site\Entity\Page;
use Jokuf\Site\Gateway\PageGatewayInterface;
use Jokuf\Site\Boundary\ICreatePageRequest;
use Jokuf\Site\DTO\CreatePageRequestDto;

class CreatePageInteractor implements ICreatePageRequest
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
            $this->pageAssembler->assmebleResponseDto(
                $page
            )
        );
    }
}