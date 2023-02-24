<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Support\SessionRegenerator;

class SignUpController extends Controller
{
    public function page(): Factory|View|Application
    {
        return view('auth.sign-up');
    }


    public function handle(SignUpFormRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        $user = $action(NewUserDTO::fromRequest($request));

        event(new Registered($user));
        SessionRegenerator::run(fn() => auth()->login($user));

        return redirect()
            ->intended(route('home'));
    }

}
