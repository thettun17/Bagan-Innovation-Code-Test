<?php

namespace App\Http\Controllers;

use App\ContentOwner;
use App\Publisher;
use App\TblBook;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookRequest;
use Facade\FlareClient\Http\Response;

class TblBookController extends Controller
{
    public function showblade()
    {
        return view('books.index');
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $data = DB::table('tbl_book')
        ->select('tbl_book.idx', 'tbl_book.book_uniq_idx', 'tbl_book.bookname', 'tbl_book.cover_photo', 'publisher.name as puname', 'content_owner.name as coname', 'tbl_book.created_timetick')
        ->leftjoin('content_owner', 'content_owner.idx', '=', 'tbl_book.co_id')
        ->leftjoin('publisher', 'publisher.idx', '=', 'tbl_book.publisher_id')
        ->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="book-edit/'.$row->idx.'"  class="edit btn btn-primary btn-sm">Edit</a>';
            $btn .= '&nbsp&nbsp<a href="javascript:void(0)" id="'.$row->idx.'" class="delete btn btn-danger btn-sm">Delete</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $publishers = Publisher::all();
        $owners = ContentOwner::all();
        return view('books.create', ['publishers' => $publishers, "owners" => $owners]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(BookRequest $request)
    {
        $file = $request->file('cover');
        $file_name = $file->getClientOriginalName();
        $file->move(public_path('/images/cover', $file_name));

        TblBook::create([
            'book_uniq_idx' => $request->bookid,
            'bookname' => $request->bookname,
            'prize' => $request->bookprize,
            'cover_photo' => $file_name,
            'co_id' => $request->co_id,
            'publisher_id' => $request->pub_id
            ]);
            return redirect('/');
        }

        /**
        * Display the specified resource.
        *
        * @param  \App\TblBook  $tblBook
        * @return \Illuminate\Http\Response
        */
        public function show(TblBook $tblBook)
        {
            //
        }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\TblBook  $tblBook
        * @return \Illuminate\Http\Response
        */
        public function edit($id)
        {
            $book = TblBook::where('idx', $id)->get();
            $publishers = Publisher::all();
            $owners = ContentOwner::all();
            return view('books.edit', ['publishers' => $publishers, "owners" => $owners, "book" => $book]);
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\TblBook  $tblBook
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {

            if($request->hasFile('cover')) {
                $file = $request->file('cover');
                $file_name = $file->getClientOriginalName();
                $file->move(public_path('/images/cover', $file_name));
                $book[0]["cover_photo"] = $file_name;
            } else {
                $book = TblBook::where('idx', $id)->get();
                $file_name = $book[0]['cover_photo'];
            }
            DB::table('tbl_book')
            ->where('idx', $id)
            ->update([
                'book_uniq_idx' => $request->bookid,
                'bookname' => $request->bookname,
                'prize' => $request->bookprize,
                'cover_photo' => $file_name,
                'co_id' => $request->co_id,
                'publisher_id' => $request->pub_id
                ]);
                return redirect('/');
            }

            /**
            * Remove the specified resource from storage.
            *
            * @param  \App\TblBook  $tblBook
            * @return \Illuminate\Http\Response
            */
            public function destroy(Request $request)
            {
                DB::table('tbl_book')->where('idx', '=', $request->id)->delete();
                return Response("Deletet Successfull");
            }
        }
