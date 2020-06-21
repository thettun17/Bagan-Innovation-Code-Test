@extends('layout')
@section('content')
<div class="container mb-5">
    <h2 class="text-center mt-3">Book Create Form</h2>
    <form action="{{url('book/create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="book_id">Book ID</label>
            <input type="text" name="bookid" class="form-control {{ $errors->has('bookid') ? ' is-invalid' : '' }}" id="book_id" placeholder="Book Id" value="{{old("bookid") }}">
            @if ($errors->has('bookid'))
            <span class="invalid-feedback" role="alert">{{ $errors->first('bookid') }}</span>
            @endif
        </div>
        <div class="form-group ">
            <label for="bookname">Book Name</label>
            <input type="text" name="bookname" class="form-control {{ $errors->has('bookname') ? ' is-invalid' : '' }}" id="bookname" placeholder="Book Name" value="{{old("bookname") }}">
            @if ($errors->has('bookname'))
            <span class="invalid-feedback" role="alert">{{ $errors->first('bookname') }}</span>
            @endif
        </div>

        <div class="form-group ">
            <label for="bookprize">Book Prize</label>
            <input type="text" name="bookprize" class="form-control {{ $errors->has('bookprize') ? ' is-invalid' : '' }}" id="bookprize" placeholder="Book Prize" value="{{old("bookprize") }}">
            @if ($errors->has('bookprize'))
            <span class="invalid-feedback" role="alert">{{ $errors->first('bookprize') }}</span>
            @endif
        </div>

        <div class="form-goup mb-3">
            <p class="mb-0">Book Cover Image</p>
            <div class="custom-file">
                <input type="file" name="cover" class="custom-file-input {{ $errors->has('cover') ? ' is-invalid' : '' }}" id="boocover" name="bookcover" value="{{old("cover") }}">
                <label class="custom-file-label" for="boocover">{{old("cover") ? old("cover") : "Choose File"}}</label>
                @if ($errors->has('cover'))
                <span class="invalid-feedback" role="alert">{{ $errors->first('cover') }}</span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <label for="co_id">Content_Owner</label>
            <select class="form-control " id="co_id" name="co_id">
                @foreach ($owners as $owner)
                <option value="{{$owner->idx}}" {{$owner->idx == old('co_id') ? 'selected' : '' }}>{{$owner->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pub_id">Publisher</label>
            <select class="form-control" id="pub_id" name="pub_id">
                @foreach ($publishers as $publisher)
                <option value="{{$publisher->idx}}" {{$publisher->idx == old("pub_id") ? 'selected' : '' }}>{{$publisher->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

@push('css')
<style>
    .mb-0 {
        margin-bottom: 0;
    }
</style>
@endpush

@push('js')
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endpush
