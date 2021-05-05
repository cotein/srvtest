<?php

namespace App\Src\Meli\WebHooks;

interface HookContract
{
    public function response_handle($wh);
}
