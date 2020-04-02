<?php

namespace App\Managers;

use App\Models\Generate;

/**
 * Class GenerateUrlManager
 * @package App\Managers
 */
class GenerateUrlManager
{
    /**
     * @param string $link
     * @return mixed
     */
    public function generateLink(string $link)
    {
        $token = Generate::generateToken();
        if (Generate::where('token', $token)->first()){
            throw new \DomainException(Generate::DEFAULT_EXCEPTION_MESSAGE);
        } else {
            return Generate::create([
                'token' => $token,
                'origin' => $link
            ]);
        }
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(string $token)
    {
        if($link = Generate::where('token', $token)->first()) {
            return redirect($link->origin);
        } else {
            throw new \DomainException(Generate::LINK_NOT_FOUND);
        }
    }
}
