@extends("layouts.admin")

@section("content")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Benutzer</h1>
</div>
<h2>{{ $title }}</h2>
{{ $users->onEachSide(2)->links() }}
@if ($event != null)
    <a class="btn btn-primary" href="{{ route('admin.users.toPdf', $users) }}?event={{ $event }}">Exportieren</a>
@else
    <a class="btn btn-primary" href="{{ route('admin.users.toPdf', $users) }}">Exportieren</a>
@endif
<div class="table-responsive">
       <table class="table table-striped table-sm">
           <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Admin</th>
                </tr>
           </thead>
           <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>
                        <a class="text-decoration-none" href="{{ route('admin.events') }}?user={{ $user->id }}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->isAdmin)
                        <span class="text-success" data-feather="check"></span>
                        @else
                        <span class="text-danger" data-feather="x"></span>
                        @endif
                    </td>
                </tr>
                @endforeach
           </tbody>
       </table>
    </div>
@endsection