<?php

namespace App\Managers;

use App\Models\Generate;

class GenerateUrlManager
{
    public function generateLink(string $link)
    {
        $token = Generate::generateToken();
        if (Generate::where('token', $token)->first()){
            throw new \DomainException(Generate::DEFAULT_EXCEPTION_MESSAGE);
        } else {
            return Generate::create([
                'token' => $token,
                'link' => $link
            ]);
        }
    }

    public function redirect(string $token)
    {
        if($link = Generate::where('token', $token)->first()) {
            $this->redirect($link->origin);
        } else {
            throw new \DomainException(Generate::LINK_NOT_FOUND);
        }
    }
}
