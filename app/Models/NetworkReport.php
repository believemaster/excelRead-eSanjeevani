<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NetworkReport extends Model
{
   use HasFactory;
   protected $guarded = [];
   protected $fillables = [
      'State',
      'Hub',
      'Spoke',
      'Doctors',
      'CHO',
      'OPD_V1',
      'OPD_V2',
      'Total_OPD',
      'HWC_V1',
      'HWC_V2',
      'Total_HWC',
      'Total_Consultation'
   ];
   public static function insertData($data)
   {

      $value = DB::table('network_reports')->get();
      if ($value->count() == 0) {
         DB::table('network_reports')->insert($data);
      }
   }
}
