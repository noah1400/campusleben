@extends("layouts.admin")

@section("content")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Benutzer</h1>
</div>
<h2>Alle Benutzer</h2>
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
                    <td>{{ $user->name }}</td>
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