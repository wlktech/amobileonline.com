<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Template</title>
</head>
<body>
     <h3>Dear A Mobile Store</h3>
     <p>{{ $contact->name }} ({{ $contact->phone }})</p>
     <p>{{ $contact->message }}</p>
</body>
</html>