Alle Daten die in Zusammenhang mit der E-Mail Adresse {{ $user->email }} gespeichert wurden: <br>
E-Mail: {{ $user->email }} <br>
Name: {{ $user->name }} <br>
Events: <br>
@foreach ($user->events as $event)
<a href="{{ route('events.show', ['id'=>$event->id]) }}">{{ $event->name }}</a> <br>
@endforeach