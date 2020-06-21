@extends('layout')
@section('content')
<div class="container">
    <h2 class="text-center mt-3">Book Edit Form</h2>
    <form action="{{url('book-update/'.$book[0]["idx"])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="book_id">Book ID</label>
            <input type="text" name="bookid" class="form-control {{ $errors->has('bookid') ? ' is-invalid' : '' }}" id="book_id" placeholder="Book Id" value="{{$book ? $book[0]["book_uniq_idx"] : old("bookid") }}">
            @if ($errors->has('bookid'))
            <span class="invalid-feedback" role="alert">{{ $errors->first('bookid') }}</span>
            @endif
        </div>
        <div class="form-group ">
            <label for="bookname">Book Name</label>
            <input type="text" name="bookname" class="form-control {{ $errors->has('bookname') ? ' is-invalid' : '' }}" id="bookname" placeholder="Book Name" value="{{$book ? $book[0]["bookname"] : old("bookname") }}">
            @if ($errors->has('bookname'))
            <span class="invalid-feedback" role="alert">{{ $errors->first('bookname') }}</span>
            @endif
        </div>

        <div class="form-group ">
            <label for="bookprize">Book Prize</label>
            <input type="text" name="bookprize" class="form-control {{ $errors->has('bookprize') ? ' is-invalid' : '' }}" id="bookprize" placeholder="Book Prize" value="{{$book ? $book[0]["prize"] : old("bookprize") }}">
            @if ($errors->has('bookprize'))
            <span class="invalid-feedback" role="alert">{{ $errors->first('bookprize') }}</span>
            @endif
        </div>

        <div class="form-goup mb-3">
            <p class="mb-0">Book Cover Image</p>
            <div class="custom-file">
                <input type="file" name="cover" class="custom-file-input {{ $errors->has('cover') ? ' is-invalid' : '' }}" id="boocover" name="bookcover" value="{{$book ? $book[0]["cover_photo"] : old("bookcover") }}">
                <label class="custom-file-label" for="boocover">{{$book ? $book[0]["cover_photo"] : "Choose File"}}</label>
                @if ($errors->has('cover'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('cover') }}</span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="co_id">Content_Owner</label>
            <select class="form-control " id="co_id" name="co_id">
                @foreach ($owners as $owner)
                <option value="{{$owner->idx}}" {{$owner->idx == $book[0]["co_id"] ? 'selected' : '' }}>{{$owner->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pub_id">Publisher</label>
            <select class="form-control" id="pub_id" name="pub_id">
                @foreach ($publishers as $publisher)
                <option value="{{$publisher->idx}}" {{$publisher->idx == $book[0]["publisher_id"] ? 'selected' : '' }}>{{$publisher->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
