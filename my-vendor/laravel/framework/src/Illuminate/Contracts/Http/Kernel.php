<?php

namespace Illuminate\Contracts\Http;

interface Kernel
{
    public function bootstrap();

    public function handle($request);

    public function teminate($request, $response);

    public function getApplication();
}

