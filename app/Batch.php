<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'elc_batches';

    protected $fillable = ['elc_id','pid','product_name','batch_desc','batch_name','batch_start','batch_end','batch_timing_start','batch_timing_end','batch_last_date_adm','status'];
}
