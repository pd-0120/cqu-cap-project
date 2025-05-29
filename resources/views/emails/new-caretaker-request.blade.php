<!DOCTYPE html>
<html>
<head>
    <title>New Caretaker Request</title>
</head>
<body>
    <h2>New Caretaker Registration Request</h2>

    <p>A new caretaker has registered on the platform:</p>

    <ul>
        <li><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Phone:</strong> {{ $user->phone }}</li>
    </ul>

    <p>Please review and approve/reject the request from the admin dashboard.</p>
</body>
</html>
