<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cell_phones = DB::table('cellphone_boards')
                        ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                        ->where('cellphone_boards.cpb_telecoms', 'kt')
                        ->select('cellphone_boards.cpb_applicant', 'users.email', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_phonenumber', 'cellphone_boards.cpb_usimnumber', 'cellphone_boards.created_at')
                        ->get();
        return $cell_phones;
    }

    // 해딩 row 추가, 이차원 배열로 2행으로 만들 수도 있습니다.
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Nationality',
            'Phone Number',
            'USIM Number',
            'Application date'
        ];
    }

    // 각 컬럼의 width 설정.
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 40,
            'C' => 20,
            'D' => 30,
            'E' => 30,
            'F' => 20,
        ];
    }

    // 스타일도 변경할 수 있습니다.
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
    }
}
