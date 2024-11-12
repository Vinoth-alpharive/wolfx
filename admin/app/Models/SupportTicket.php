<?php

namespace App\Models;
use App\Models\SupportTicketImage;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'supporttickets';

    public function images()
    {
        return $this->hasMany(SupportTicketImage::class, 'ticket_id', 'ticket_id');
    }
}


?>