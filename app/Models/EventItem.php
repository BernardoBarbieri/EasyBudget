<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventItem extends Model
{
    protected $fillable = ['budget_id','service_item_id','quantity','unit_price','total'];
    public function service(){ return $this->belongsTo(ServiceItem::class,'service_item_id'); }
}
