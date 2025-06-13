@extends('layouts.app')
@section('content')
<h2> Subscriptions für {{ $sub->name }}</h2>

<table class="table">

    <tr>
        <td>Id</td><td>{{ $sub ->id }} </td></tr><tr>
        <td>Name</td> <td>{{ $sub ->name }} </td></tr><tr>
        <td>Contact</td><td>{{ $sub ->contact}} </td></tr><tr>
        <td>Price</td><td>{{ $sub ->price}} </td></tr><tr>
        <td>Subscribed at</td><td>{{ $sub ->subscribed_at }} </td></tr><tr>
        <td>Subscription end</td><td>{{ $sub ->subscription_end }} </td></tr><tr>
        <td>Created At</td><td>{{ $sub -> created_at }} </td></tr><tr>
        <td>Updated At</td><td>{{ $sub -> updated_at }} </td></tr><tr>

    </tr>

</table> 
@endsection
