@extends('layouts.app')
@section('content')
<h2> Liste der Subscriptions </h2>

<table class="table">
    <tr>     
        <th> Name </th>
        <td>Subscriptions</td>
    </tr>

@foreach ($mts as $mt)
    <tr>
        <td>{{ $mt ->name }} </td>
        <td>
            <ul>
                @foreach ($mt->subscriptions as $mt)
                <li>{{ $mt->name }}</li>
                @endforeach
            </ul>
        </td>
        
    </tr>
@endforeach
</table> 

<form action="{{ route('mediatypes.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Mediatype name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary"> Add Mediatype </button>
</form>


@endsection


