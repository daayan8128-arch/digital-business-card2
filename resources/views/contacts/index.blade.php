<!DOCTYPE html>
<html>

<head>
    <title>Contact List</title>
</head>

<body>
    <h1>Contact Submissions</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>
                        @if($contact->image)
                        <img src="{{ asset('storage/' . $contact->image) }}" alt="Image" width="150"> @else
                            No Image
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>