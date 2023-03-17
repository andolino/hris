<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use DB;

class Table extends Model
{
    use HasFactory;

    /**
     * GLOBAL VARIABLE FOR DATATABLES
     */
    protected static $tbl;
    protected static $tblColumns;
    protected static $tblOrder;

    public static function whereFn($q){
      $route = \Route::current()->uri();
      $users = \Auth::user();
      $tbl = self::$tbl;
      $request = Request::all(); 
      switch ($route) {
        case 'server-employees-list':
          $q->where("branch_id", $users->branch_id);
          if ($request['employee_type'] == 'employee-monthly') {
            //monthly
            $q->where('payroll_schedule_id', 1);
          } else {
            //weekly
            $q->where('payroll_schedule_id', 2);
          }
          break;
        case 'server-missed-in-out':
          // $q->where("branch_id", $users->branch_id);
          if ($request['dtr_type'] == 'in') {
            $q->where("time_in", '00:00:00');
            $q->where('time_out', '<>', '00:00:00');
          } elseif ($request['dtr_type'] == 'out'){
            $q->where("time_out", '00:00:00');
            $q->where('time_in', '<>', '00:00:00');
          }
          break;
        case 'server-payroll':
          $q->where("payroll_schedule_id", $request['payroll_type']);
          break;
        default:
          break;
      }
    }

    public static function _que_tbl(){
        
      $initPost   = Request::all(); 
      $query      = DB::table(self::$tbl)->select('*');
      $query->where("is_deleted", 0);
      $i          = 0;
      // add for where
      self::whereFn($query);
      foreach (self::$tblColumns as $item) {
        if (!empty($initPost['search']['value'])) {
          if ($i === 0) {
            $query->where($item, 'like', '%' . strtolower($initPost['search']['value']) . '%');
          } else {
            $query->orWhere($item, 'like', '%' . strtolower($initPost['search']['value']) . '%');
          }
          // add for where
          self::whereFn($query);
        }
        $column[$i] = $item;
        $i++;
      }
      if (isset($initPost['order'])) {
        $query->where("is_deleted", 0);
        $query->orderBy($column[$initPost['order']['0']['column']], $initPost['order']['0']['dir']);
      }elseif(self::$tblOrder){
        $query->where('is_deleted', '0');
        $order = self::$tblOrder;
        $query->orderBy(key($order), $order[key($order)]);
      }
      $query->orderBy(key($order), $order[key($order)]);
  
      return $query;
    }
    
    public static function getOutputTbl($tbl, $tblColumns=array(), $tblOrder=array()){
      self::$tbl = $tbl;
      self::$tblColumns = $tblColumns;
      self::$tblOrder = $tblOrder;
      $initPost = Request::all();
      $q = self::_que_tbl();
      if (!empty($initPost['length']))
      $q->limit(($initPost['length'] < 0 ? 0 : $initPost['length']))->offset($initPost['start']);
      $result = $q->get();
      return $result;
    }
  
    public static function countAllTbl(){
      $count = DB::table(self::$tbl)->where('is_deleted', 0)->get();
      return count($count);
    }
  
    public static function countFilterTbl(){
      $q = self::_que_tbl()->get();
      return count($q);
    }
}
