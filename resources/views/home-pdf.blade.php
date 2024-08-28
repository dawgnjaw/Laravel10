<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-container">
  <h2>Striped Bordered Table</h2>

    <table class="w3-table w3-striped w3-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Age</th>
            <th>Adress</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->age }}</td>
            <td>{{ $row->adress }}</td>
        </tr>
        @endforeach
    </table>
</div>

</body>
</html>
