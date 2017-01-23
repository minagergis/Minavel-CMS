<!DOCTYPE>
<html>
    <head></head>

    <body>

        <p>Name : {{ $name or '' }}</p>
        <p>Email : {{ $email or '' }}</p>
        <p>Message:<br>{{ $msg or '' }}</p>

        <br><br>

        <p>This contact sent from {{ route('frontend.home.get') }}</p>

    </body>
</html>