<?php

declare(strict_types=1);

namespace App\Contracts\Actions;

use Illuminate\Http\Request;

interface ShowUserActionContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): mixed;
}
