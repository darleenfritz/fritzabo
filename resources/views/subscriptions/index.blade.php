@extends('layouts.app')
@section('content')
<h2> Liste der Subscriptions </h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table">
    <tr>
        <th> ID </th>
        <th> Name </th>
        <th> Contact </th>
        <th> Price </th>
        <th> Subscribed at </th>
        <th> Subscription end </th>
        <th> Action </th>


    </tr>

@foreach ($subs as $sub)
    <tr>
        <td>{{ $sub ->id }} </td>
        <td>{{ $sub ->name }} </td>
        <td>{{ $sub->contact}}</td>
        <td>{{ $sub ->price}} </td>
        <td>{{ $sub ->subscribed_at }} </td>
        <td>{{ $sub ->subscription_end }} </td>
        <td><a href= "{{ route('subscriptions.show', $sub) }}">Details
            <a href="{{ route('subscriptions.edit', $sub) }}">Bearbeiten</a>
            <form action="{{ route('subscriptions.destroy', $sub->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Wirklich löschen?')">Löschen</button>
            </form>
            
        </td>
    </tr>
@endforeach

</table> 
@endsection