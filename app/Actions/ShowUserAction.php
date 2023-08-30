<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\ShowUserActionContract;
use Illuminate\Http\Request;

class ShowUserAction implements ShowUserActionContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): mixed
    {
        return $request->user();
    }
}
