<?php


namespace App\Http\Controllers\Api\Auth;


use App\Contracts\Http\Controllers\Auth\ForgotResetContractInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ForgotResetController extends Controller implements ForgotResetContractInterface
{

    /**
     * @inheritDoc
     */
    public function forgot(): Response
    {
        // TODO: Implement forgot() method.
    }

    /**
     * @inheritDoc
     */
    public function reset(): Response
    {
        // TODO: Implement reset() method.
    }
}
