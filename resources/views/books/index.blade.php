@extends('layout')
@section('content')
<div class="container mt-5">
    <table class="table table-bordered data-table ">
        <thead>
            <tr>
                <th>No</th>
                <th>Book Name</th>
                <th>Cover_photo</th>
                <th>Publisher</th>
                <th>Content Owner</th>
                <th>Created Date</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection

@push('js')
<script>
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('book.index') }}",
            columns: [
            {
                data: "book_uniq_idx",
                name: 'book_uniq_idx'
            },
            {
                data: "bookname",
                name: "bookname"
            },
            {
                data: "cover_photo",
                name: "cover_photo"
            },
            {
                data: "puname",
                name: "puname"
            },
            {
                data: "coname",
                name: "coname"
            },
            {
                data: "created_timetick",
                name: "created_timetick"
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            ]
        });

    });

    $(document).on('click', '.delete', function() {
        let $bookid = $(this).attr('id');
        $.ajax({
            type: 'get',
            url: '{{URL::to("book-destry")}}',
            data: {'id':$bookid},
            success: function(data) {
                location.reload();
            }
        });
    });

</script>
@endpush
