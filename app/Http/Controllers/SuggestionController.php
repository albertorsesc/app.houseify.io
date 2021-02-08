<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Suggestion;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuggestionRequest;
use App\Notifications\NotifyNewSuggestion;

class SuggestionController extends Controller
{
    public function store(SuggestionRequest $request) : RedirectResponse
    {
        $suggestion = Suggestion::create($request->all());

        $rootUsers = User::query()->whereIn('email', config('houseify.roles.root'))->get();

        \Notification::send($rootUsers, new NotifyNewSuggestion($suggestion));

        return redirect()->route('web.suggestions.index')->with('success', 'Gracias por tus sugerencias!');
    }
}
