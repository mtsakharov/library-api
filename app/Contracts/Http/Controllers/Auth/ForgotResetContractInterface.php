<?php
declare(strict_types=1);

namespace App\Contracts\Http\Controllers\Auth;

use Illuminate\Http\Response;

interface ForgotResetContractInterface
{
    /**
     * @return Response
     */
    public function forgot(): Response;

    /**
     * @return Response
     */
    public function reset(): Response;
}
