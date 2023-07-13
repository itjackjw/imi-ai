<?php

declare(strict_types=1);

namespace app\Module\Wallet\Enum;

use Imi\Enum\Annotation\EnumItem;
use Imi\Enum\BaseEnum;

class OperationType extends BaseEnum
{
    #[EnumItem(text: '系统赠送')]
    public const GIFT = 1;

    #[EnumItem(text: '消费')]
    public const PAY = 2;

    #[EnumItem(text: '退款')]
    public const REFUND = 3;
}
