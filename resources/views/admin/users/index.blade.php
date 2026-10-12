@extends('layouts.admin', ['title' => 'Users & access'])

@section('content')
    <section class="admin-page-heading mb-4.5 flex flex-col items-start gap-5 rounded-2xl bg-ink p-7 text-white lg:flex-row lg:items-end lg:justify-between lg:rounded-lg lg:p-9 [&_h1]:my-2.5 [&_h1]:text-[clamp(38px,8vw,60px)] [&_p:not(.eyebrow)]:max-w-175 [&_p:not(.eyebrow)]:text-[13px] [&_p:not(.eyebrow)]:leading-[1.8] [&_p:not(.eyebrow)]:text-[#eadfe4] [&_.eyebrow]:text-gold">
        <div>
            <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">People & permissions</p>
            <h1>Users & access.</h1>
            <p>View registered members and decide who can enter the administrative workspace.</p>
        </div>
        <div class="admin-user-summary grid min-w-45 rounded-xl border border-white/15 bg-white/5 p-4.5"><strong>{{ $users->total() }}</strong><span>Registered users</span><small>{{ $administratorCount }} {{ str('administrator')->plural($administratorCount) }}</small></div>
    </section>

    <section class="admin-panel rounded-2xl border border-line bg-paper p-5 lg:rounded-lg lg:p-7 admin-users-panel">
        <div class="admin-users-toolbar flex flex-col gap-4 border-b border-line pb-5 lg:flex-row lg:items-end lg:justify-between [&_input]:min-h-11 [&_input]:flex-1 [&_input]:rounded-lg [&_input]:border [&_input]:border-line [&_input]:bg-white [&_input]:px-3 [&_input]:text-[11px] [&_button]:inline-flex [&_button]:min-h-11 [&_button]:items-center [&_button]:rounded-lg [&_button]:px-3.5 [&_button]:text-[10px] [&_button]:font-bold [&_form_a]:inline-flex [&_form_a]:min-h-11 [&_form_a]:items-center [&_form_a]:rounded-lg [&_form_a]:px-3.5 [&_form_a]:text-[10px] [&_form_a]:font-bold [&_button]:bg-ink [&_button]:text-white">
            <div><p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">Access directory</p><h2>Registered accounts</h2></div>
            <form action="{{ route('admin.users.index') }}" method="GET" role="search">
                <label class="sr-only" for="user-search">Search users</label>
                <input id="user-search" type="search" name="search" value="{{ $search }}" placeholder="Search name or email">
                <button type="submit">Search</button>
                @if($search !== '')<a href="{{ route('admin.users.index') }}">Clear</a>@endif
            </form>
        </div>

        <div class="admin-user-list grid">
            @forelse($users as $user)
                <article class="admin-user-row grid grid-cols-[auto_1fr] gap-3.5 border-b border-line py-5 lg:grid-cols-[auto_1.4fr_.7fr_auto] lg:items-center">
                    <span class="admin-user-avatar grid size-11 place-items-center rounded-full bg-[#f1e7ec] font-display text-lg text-plum">{{ str($user->name)->explode(' ')->take(2)->map(fn ($part) => str($part)->substr(0, 1))->implode('') }}</span>
                    <div class="admin-user-details min-w-0 [&_h3]:font-sans [&_h3]:text-xs [&_h3]:font-extrabold [&_p]:mt-1 [&_p]:text-[10px] [&_p]:text-muted"><h3>{{ $user->name }} @if(auth()->user()->is($user))<small>You</small>@endif</h3><p>{{ $user->email }}</p><span>Joined {{ $user->created_at->format('M j, Y') }}</span></div>
                    <div class="admin-role-state col-start-2 lg:col-auto"><span @class(['is-admin' => $user->is_super_admin])>{{ $user->is_super_admin ? 'Administrator' : 'Member' }}</span><small>{{ $user->is_super_admin ? 'Dashboard access' : 'Public account only' }}</small></div>
                    <div class="admin-role-action col-start-2 lg:col-auto lg:justify-self-end [&_button]:inline-flex [&_button]:min-h-9 [&_button]:items-center [&_button]:rounded-lg [&_button]:bg-ink [&_button]:px-3 [&_button]:py-2 [&_button]:text-[9px] [&_button]:font-bold [&_button]:text-white">
                        @if(auth()->user()->is($user))
                            <span>Current account</span>
                        @else
                            <form action="{{ route('admin.users.administrator.update', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="is_super_admin" value="{{ $user->is_super_admin ? 0 : 1 }}">
                                <button type="submit" @class(['is-remove' => $user->is_super_admin])>{{ $user->is_super_admin ? 'Remove admin' : 'Make administrator' }}</button>
                            </form>
                        @endif
                    </div>
                </article>
            @empty
                <div class="admin-users-empty grid justify-items-center px-5 py-12 text-center"><x-admin-icon name="users" /><h3>No users found</h3><p>Try another name or email address.</p></div>
            @endforelse
        </div>

        @if($users->hasPages())<div class="admin-pagination border-t border-line pt-5">{{ $users->links() }}</div>@endif
    </section>
@endsection
