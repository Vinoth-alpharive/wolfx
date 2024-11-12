<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Events\AfterSheet;


class UserExport implements FromQuery, WithHeadings,WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function headings(): array
    {
        return [
            'User ID',
            'Role',
            'User Name',
            'Email',
            'Phone Number',
            'createdAt',
            'updatedAt',
        ];
    }
    public function query()
    {
        

        return User::query()->where(['user_type' => 'Seller'])->orderBy('id', 'desc');
        /*you can use condition in query to get required result
         return Bulk::query()->whereRaw('id > 5');*/
    }
    public function map($user): array
    {
        return [
            $user->id,
            $user->role,
            $user->username,
            $user->email,
            $user->phone_no ? $user->phone_no : '-',
            date('dS M, Y', strtotime($user->created_at)),
            date('dS M, Y', strtotime($user->updated_at)),
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
