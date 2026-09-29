<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('search'));

        $users = User::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('is_super_admin')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', [
            'menuGroups' => config('menu.groups', []),
            'users' => $users,
            'search' => $search,
            'administratorCount' => User::query()->where('is_super_admin', true)->count(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'is_super_admin' => ['required', 'boolean'],
        ]);

        $grantAccess = (bool) $validated['is_super_admin'];

        if ($request->user()->is($user) && ! $grantAccess) {
            return back()->with('error', 'You cannot remove your own administrator access.');
        }

        if (! $grantAccess && $user->is_super_admin && User::query()->where('is_super_admin', true)->count() <= 1) {
            return back()->with('error', 'The final administrator cannot be removed.');
        }

        $user->update(['is_super_admin' => $grantAccess]);

        return back()->with('status', $grantAccess ? 'Administrator access granted.' : 'Administrator access removed.');
    }
}
