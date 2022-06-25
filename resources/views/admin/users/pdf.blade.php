<!DOCTYPE html>
<html lang="de">
<head>
</head>
<body style="text-align: center">
    <!-- Table of all users -->
    <div style="width: 100%">
        <table style="width: 100%">
            <thead style="border-bottom:1px solid black">
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Anwesend</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $u)
                <tr style="text-align: center; border-bottom: 1px solid black; padding: 2px">
                    <th>{{ $u['index'] }}</th>
                    <td>{{ $u['name'] }}</td>
                    <td>{{ $u['email'] }}</td>
                    <td style="border: 1px solid black"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>