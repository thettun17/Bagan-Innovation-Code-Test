<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblBook extends Model
{
    protected $table = "tbl_book";

    protected $fillable = [
        'book_uniq_idx',
        'bookname',
        'prize',
        'cover_photo',
        'co_id',
        'publisher_id',
        'created_timetick'
    ];

    public $timestamps = false;
}
