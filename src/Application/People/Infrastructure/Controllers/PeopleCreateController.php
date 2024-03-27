<?php

namespace Src\Application\People\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\People\Application\Create\PeopleCreateUseCase;
use Src\Application\People\Infrastructure\Requests\PeopleCreateRequest;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class PeopleCreateController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(
        private readonly PeopleCreateUseCase $peopleCreateUseCase
    )
    {

    }
    /**
     * @return JsonResponse
     */
    public function __invoke(PeopleCreateRequest $request): JsonResponse
    {
        return $this->jsonResponse(
            $this->created(),
            false,
            $this->peopleCreateUseCase->__invoke($request->toArray())->entity()
        );
    }
}
