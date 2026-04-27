@section('content')

<h1>hello</h1>

<ul>
    @foreach ($cours as $c)
    <li>
         {{ $c->matiere }} le {{\Carbon\Carbon::parse($c->date)->format('d/m/Y') }} de {{\Carbon\Carbon::parse($c->heure_debut)->format('H\hi')}}
         à {{\Carbon\Carbon::parse($c->heure_fin)->format('H\hi')}} en salle {{ $c->salle }}
    </li>
    @endforeach
    </ul>
