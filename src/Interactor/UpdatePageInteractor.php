<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Assembler\PageAssembler;
use Jokuf\Site\Boundary\IUpdatePageResponse;
use Jokuf\Site\DTO\CreatePageRequestDto;
use Jokuf\Site\Gateway\PageGatewayInterface;

class UpdatePageInteractor implements IUpdatePageResponse
{
    /**
     * @var PageGatewayInterface
     */
    private $gateway;
    /**
     * @var IUpdatePageResponse
     */
    private $response;
    /**
     * @var PageAssembler
     */
    private $assembler;

    public function __construct(PageGatewayInterface $gateway, IUpdatePageResponse $response)
    {
        $this->assembler = new PageAssembler();
        $this->gateway = $gateway;
        $this->response = $response;
    }

    public function present(CreatePageRequestDto $pageDTO): void
    {
        $page = $this->assembler->assembleEntity($pageDTO);
        $page->save($this->gateway);

        $this->response->present(
            $this->assembler->assmebleResponseDto(
                $page
            )
        );
    }
}