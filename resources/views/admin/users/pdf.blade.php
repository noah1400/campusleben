<!DOCTYPE html>
<html lang="de">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
                <tr style="text-align: center; {{ ($u['index']%2==0)?'background-color: #ebedef':'background-color: #f8fafc' }}">
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