<!DOCTYPE html>
<html lang="de">
<head>
</head>
<body>
    <!-- Table of all users -->
    <div style="width: 100%">
    {{ $users->count() }}
        <table class="table table-bordered mb-5">
            <thead style="border-bottom:1px solid black">
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Anwesend</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $data)
                <tr style="">
                    <th>{{ $data->id }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td style=""></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>