<?php

namespace App\Exports;

use App\Models\CoinWithdraw;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Events\AfterSheet;


class WithdrawExport implements FromQuery, WithHeadings,WithEvents, WithMapping
{
    public function __construct($histroys)
    {
        $this->histroys= $histroys;
        //  dd($histroys);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function headings(): array
    {
        return [
            'User ID',
            'First Name',
            'Last Name',
            'Email ID',
            'Asset',
            'TXN ID',
            'Order ID',
            'Network',
            'Destination Tag',
            'Sender',
            'Recipient',
            'Credit Amount',
            'Admin Fee',            
            'Amount',
            'Status',
            'createdAt',
            'updatedAt',
        ];
    }
    
    // public function query()
    // {
    //     if($this->coin == 'All'){
    //         return CoinWithdraw::query();
    //     }else{
    //         return CoinWithdraw::query()->where('coin_name',$this->coin);
    //     }
        
    //     /*you can use condition in query to get required result
    //      return Bulk::query()->whereRaw('id > 5');*/
    // }

    public function query()
    {
        return CoinWithdraw::whereIn('id', $this->histroys->pluck('id')->toArray());
    } 

    public function map($histroys): array
    {
        return [
            $histroys->uid,
            $histroys->user['first_name'],
            $histroys->user['last_name'],
            $histroys->user['email'],
            $histroys->coin_name,
            $histroys->txid,
            $histroys->transaction_id,
            $histroys->network,
            $histroys->destination_tag,
            $histroys->sender,
            $histroys->to_addr,
            $histroys->request_amount,
            $histroys->admin_fee,            
            $histroys->amount,
            $histroys->status == 0 ? 'Pending' : 'Accept',
            date('d-M-Y', strtotime($histroys->created_at)),
            date('d-M-Y', strtotime($histroys->updated_at)),
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
            },
        ];
    }
}
