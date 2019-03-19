<h1>Тема: {{ $contact['subject'] }}</h1>

<h2 style="display: inline-block;">От: {{ $contact['name'] }}, {{ $contact['email'] }}</h2>

<br>

<h2>Съобщение: </h2>
<hr>
<p>
    <h3 style="line-height: 1.2;">{{ $contact['message'] }}</h3>
</p>