<?php

declare(strict_types=1);

namespace app\Module\Card\ApiController\Admin;

use app\Module\Admin\Annotation\AdminLoginRequired;
use app\Module\Card\Service\CardService;
use app\Module\Card\Service\MemberCardService;
use app\Util\RequestUtil;
use Imi\Aop\Annotation\Inject;
use Imi\Server\Http\Controller\HttpController;
use Imi\Server\Http\Route\Annotation\Action;
use Imi\Server\Http\Route\Annotation\Controller;

#[Controller(prefix: '/admin/card/')]
class CardController extends HttpController
{
    #[Inject]
    protected CardService $cardService;

    #[Inject]
    protected MemberCardService $memberCardService;

    #[
        Action,
        AdminLoginRequired()
    ]
    public function memberInfos(string|int|array $memberIds): array
    {
        return [
            'data' => $this->memberCardService->getBalances(RequestUtil::parseArrayParams($memberIds)),
        ];
    }
}
