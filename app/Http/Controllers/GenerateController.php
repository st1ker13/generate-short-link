<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateRequest;
use App\Managers\GenerateUrlManager;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    private $generateManager;

    public function __construct(GenerateUrlManager $generateManager)
    {
        $this->generateManager = $generateManager;
    }

    public function index()
    {
        return view('welcome');
    }

    public function store(GenerateRequest $request)
    {
        try {
            $link = $this->generateManager->generateLink($request->link);
            return view('welcome', compact('link'));
        } catch (\DomainException $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function redirect(Request $request)
    {
        try {
            $this->generateManager->redirect($request->token);
        } catch (\DomainException $exception) {
            return redirect('/')->with('error', $exception->getMessage());
        }
    }
}
