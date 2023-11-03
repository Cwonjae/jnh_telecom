<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $search_tag;
    private $search_text;

    public function __construct(string $search_tag, string $search_text) {
        $this->search_tag = $search_tag;
        $this->search_text = $search_text;
    }

    public function collection()
    {
        $cell_phones_check = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->where('cellphone_boards.cpb_telecoms', 'kt');

        if($this->search_tag && $this->search_text) {
            switch($this->search_tag) {
                case 'username' :
                    $cell_phones_check->where('cellphone_boards.cpb_applicant', $this->search_text);
                    break;
                case 'email' :
                    $cell_phones_check->where('users.email', $this->search_text);
                    break;
                case 'phonenumber' :
                    $cell_phones_check->where('cellphone_boards.cpb_phonenumber', $this->search_text);
                    break;
                case 'usimnumber' :
                    $cell_phones_check->where('cellphone_boards.cpb_usimnumber', $this->search_text);
                    break;
            }
        }

        $cell_phones = $cell_phones_check->select('cellphone_boards.cpb_applicant', 'users.email', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_phonenumber', 'cellphone_boards.cpb_usimnumber', 'cellphone_boards.created_at')
        ->get();


        // $cell_phones = DB::table('cellphone_boards')
        //                 ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
        //                 ->where('cellphone_boards.cpb_telecoms', 'kt')
        //                 ->select('cellphone_boards.cpb_applicant', 'users.email', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_phonenumber', 'cellphone_boards.cpb_usimnumber', 'cellphone_boards.created_at')
        //                 ->get();
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

    // 스타일도 변경할 수 있습니다.
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
    }
}
