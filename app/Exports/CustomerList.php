<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use DB;
use App\Customer;

class CustomerList implements FromCollection, WithHeadings 
{
	/**
    * @return \Illuminate\Support\Collection
    */
	public function collection()
	{
		//echo "winl rr";
		$abc = $_GET['search'];
		$users = DB::table('customers')
				->select('id','name','email','nrc','address','position','join_date')
				->where('name','=',$abc)
				->orWhere('email', 'like', '%'.$abc.'%')
				->get();
		return $users;
	}

	public function headings(): array
    {
        return [
		'ID',
        'Name',
        'Email',
        'NRC',
        'Address',
        'Position',
        'Join-Date'
        ];
    }
}