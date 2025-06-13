@extends('layouts.app')
@section('content')
    <h2> Subscriptions für {{ $sub->name }}</h2>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif 
    <form action="{{ route('subscriptions.update', $sub) }}" method="POST">
        @method('PUT')
        @csrf
        <table class="table">

            <tr>
                <td>Id</td>
                <td>{{ $sub->id }} </td>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="name" value="{{ $sub->name }}" />
                    @if ($errors->has('name'))
                     @foreach($errors->get('name') as $error)
                        <span class="text-danger">{{ $error }}
                     @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><input type="text" name="contact" value="{{ $sub->contact }}" </td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="price" value="{{ $sub->price }}" </td>
            </tr>
            <tr>
                <td>Subscribed at</td>
                <td>{{ $sub->subscribed_at }} </td>
            </tr>
            <tr>
                <td>Subscription end</td>
                <td><input type="text" name="subscription_end" value="{{ $sub->subscription_end }}" </td>
            </tr>
            <tr>
                <td>Created At</td>
                <td>{{ $sub->created_at }} </td>
            </tr>
            <tr>
                <td>Updated At</td>
                <td>{{ $sub->updated_at }} </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="submit"/>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
