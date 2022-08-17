<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeRetirementDetailExport implements FromCollection, WithHeadings, WithEvents
{
    protected $data;
    protected $slno;
    protected $Healper;
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($alldata)
    {
        $this->data = $alldata['employee_list'];
        $this->slno = $alldata['slno'];
        $this->Healper = new ExcelhealperFunction;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
       return $this->data;
      // return collect($this->data);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            // 'EMPLOYEE TYPE',
            // 'EMPLOYEE CATEGORY',
            // 'CODE',
            // 'EMPLOYEE NAME',
            // 'DESIGNATION',
            // 'DEPARTMENT',
            // 'ACTIVE TYPE',
            // 'JOINING DATE'
        ];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */ 
    public function registerEvents(): array
    {
    return [
        AfterSheet::class => function (AfterSheet $event) {
            $styleArray = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $event->sheet->getDelegate()->getStyle('A1:I1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:I1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:I1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:I1')->setCellValue('A1', "THE SAMAJ");  
            

            $event->sheet->getDelegate()->getStyle('A2:I2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:I2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:I2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:I2')->setCellValue('A2', "RETIRED EMPLOYEES DETAIL REPORTS");
          

            $event->sheet->getDelegate()->getStyle('A3:I3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:I3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:I3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A3', "SL NO");
            $event->sheet->setCellValue('B3', "EMPLOYEE NAME");
            $event->sheet->setCellValue('C3', "DESIGNATION");
            $event->sheet->setCellValue('D3', "DEPARTMENT");
            $event->sheet->setCellValue('E3', "ACTIVE TYPE");
            $event->sheet->setCellValue('F3', "DATE OF BIRTH");
            $event->sheet->setCellValue('G3', "JOINING DATE");
            $event->sheet->setCellValue('H3', "RETIREMENT DATE");
            $event->sheet->setCellValue('I3', "EMPLOYEE CATEGORY");
            $i=4;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":I".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('E'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('E'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, @$val->desg_name);
            $event->sheet->setCellValue('D'.$i, @$val->dept_name);
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetModifydate(@$val->DOB));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetModifydate(@$val->DOJ));
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetModifydate(@$val->retirement_date));
            $event->sheet->setCellValue('I'.$i, @$val->category_name);
            $i++;
            }
        },
    ];
    }
}
