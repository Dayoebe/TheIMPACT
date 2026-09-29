@extends('layouts.admin', ['title' => 'Users & access'])

@section('content')
    <section class="admin-page-heading">
        <div>
            <p class="eyebrow">People & permissions</p>
            <h1>Users & access.</h1>
            <p>View registered members and decide who can enter the administrative workspace.</p>
        </div>
        <div class="admin-user-summary"><strong>{{ $users->total() }}</strong><span>Registered users</span><small>{{ $administratorCount }} {{ str('administrator')->plural($administratorCount) }}</small></div>
    </section>

    @if(session('status'))<div class="admin-alert is-success" role="status">{{ session('status') }}</div>@endif
    @if(session('error'))<div class="admin-alert is-error" role="alert">{{ session('error') }}</div>@endif

    <section class="admin-panel admin-users-panel">
        <div class="admin-users-toolbar">
            <div><p class="eyebrow">Access directory</p><h2>Registered accounts</h2></div>
            <form action="{{ route('admin.users.index') }}" method="GET" role="search">
                <label class="sr-only" for="user-search">Search users</label>
                <input id="user-search" type="search" name="search" value="{{ $search }}" placeholder="Search name or email">
                <button type="submit">Search</button>
                @if($search !== '')<a href="{{ route('admin.users.index') }}">Clear</a>@endif
            </form>
        </div>

        <div class="admin-user-list">
            @forelse($users as $user)
                <article class="admin-user-row">
                    <span class="admin-user-avatar">{{ str($user->name)->explode(' ')->take(2)->map(fn ($part) => str($part)->substr(0, 1))->implode('') }}</span>
                    <div class="admin-user-details"><h3>{{ $user->name }} @if(auth()->user()->is($user))<small>You</small>@endif</h3><p>{{ $user->email }}</p><span>Joined {{ $user->created_at->format('M j, Y') }}</span></div>
                    <div class="admin-role-state"><span @class(['is-admin' => $user->is_super_admin])>{{ $user->is_super_admin ? 'Administrator' : 'Member' }}</span><small>{{ $user->is_super_admin ? 'Dashboard access' : 'Public account only' }}</small></div>
                    <div class="admin-role-action">
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
                <div class="admin-users-empty"><x-admin-icon name="users" /><h3>No users found</h3><p>Try another name or email address.</p></div>
            @endforelse
        </div>

        @if($users->hasPages())<div class="admin-pagination">{{ $users->links() }}</div>@endif
    </section>
@endsection
