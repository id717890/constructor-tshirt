<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ContractFizik1 implements FromView
{
    private $fio;
    private $date;
    private $number;
    private $buyer;

    public function __construct($fio, $number, $date, $buyer)
    {
        $this->buyer = $buyer;
        $this->fio = $fio;
        $this->date = $date;
        $this->number = $number;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('email.fizik_doc1', [
            'fio' => $this->fio,
            'number' => $this->number,
            'date' => $this->date,
            'buyer' => $this->buyer
        ]);
//            ->with('fio', $this->fio)
//            ->with('number', $this->number)
//            ->with('date', $this->date)
//            ->with('buyer', $this->buyer);
    }
}
