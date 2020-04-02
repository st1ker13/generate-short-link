<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateRequest;
use App\Managers\GenerateUrlManager;
use Illuminate\Http\Request;

/**
 * Class GenerateController
 * @package App\Http\Controllers
 */
class GenerateController extends Controller
{
    private $generateManager;

    /**
     * GenerateController constructor.
     * @param GenerateUrlManager $generateManager
     */
    public function __construct(GenerateUrlManager $generateManager)
    {
        $this->generateManager = $generateManager;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @param GenerateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(GenerateRequest $request)
    {
        try {
            $link = $this->generateManager->generateLink($request->link);
            return view('welcome', compact('link'));
        } catch (\DomainException $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request)
    {
        try {
            return $this->generateManager->redirect($request->token);
        } catch (\DomainException $exception) {
            return redirect('/')->with('error_redirect', $exception->getMessage());
        }
    }
}
