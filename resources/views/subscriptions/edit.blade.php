@extends('layouts.app')
@section('content')
<form action="{{ route('subscriptions.update', $sub->id) }}" method="post">
   @csrf
   @method("PUT")
   <div class="row">
       <div class="mb-3 row">
           <label for="code" class="col-md-4 col-form-label text-md-end text-start">Name</label>
           <div class="col-md-6">
               <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" >
               @if ($errors->has('name'))
               <span class="text-danger">{{ $errors->first('name') }}</span>
               @endif
           </div>
       </div>

       <div class="mb-3 row">
           <label for="code" class="col-md-4 col-form-label text-md-end text-start">Contact</label>
           <div class="col-md-6">
               <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" >
               @if ($errors->has('contact'))
               <span class="text-danger">{{ $errors->first('contact') }}</span>
               @endif
           </div>
       </div>

       <div class="mb-3 row">
           <label for="code" class="col-md-4 col-form-label text-md-end text-start">Preis</label>
           <div class="col-md-6">
               <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" >
               @if ($errors->has('price'))
               <span class="text-danger">{{ $errors->first('price') }}</span>
               @endif
           </div>
       </div>

       <div class="mb-3 row">
           <label for="code" class="col-md-4 col-form-label text-md-end text-start">Subscribed at</label>
           <div class="col-md-6">
               <input type="text" class="form-control @error('subscribed_at') is-invalid @enderror" id="subscribed_at" name="subscribed_at" >
               @if ($errors->has('subscribed_at'))
               <span class="text-danger">{{ $errors->first('subscribed_at') }}</span>
               @endif
           </div>
       </div>

       <div class="mb-3 row">
           <label for="code" class="col-md-4 col-form-label text-md-end text-start"> Mediatype</label>
           <div class="col-md-6">
               <input type="text" class="form-control @error('mediatype_id') is-invalid @enderror" id="mediatype_id" name="mediatype_id" >
               @if ($errors->has('mediatype_id'))
               <span class="text-danger">{{ $errors->first('mediatype_id') }}</span>
               @endif
               <span>{{ $sub->mediatype }}<br>
               <select name="mediatype_id">
                    @foreach ($mts as $mt)
                        <option value="{{$mt->id}}"@selected($mt->id == $sub->mediatype_id) >{{$mt->name}}</option>
                    @endforeach
                </select>
           </div>
       </div>

       <div class="mb-3 row">
           <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
       </div>
   </div>
</form>
@endsection