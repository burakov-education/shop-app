<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Admin auth form
     *
     * @return View|Application|Factory
     */
    public function login(): View|Application|Factory
    {
        return view('login');
    }

    /**
     * Admin auth
     *
     * @param AuthRequest $request
     * @return RedirectResponse
     */
    public function auth(AuthRequest $request): RedirectResponse
    {
        if (auth()->attempt($request->validated())) {
            return redirect()->route('categories.index');
        }

        return redirect()
            ->back()
            ->with('incorrect', true)
            ->withInput($request->validated());
    }

    /**
     * Logout
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->guard('web')->logout();

        return redirect()->route('login');
    }
}
