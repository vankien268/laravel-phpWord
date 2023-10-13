<?php

namespace App\Biz\Newway\Template;

interface ICpmsTemplate
{
    public function convertMustache($view, array $data);

    public function convertMustacheReport($view, array $data);
}
