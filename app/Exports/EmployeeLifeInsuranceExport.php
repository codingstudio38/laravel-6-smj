<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeLifeInsuranceExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->mergeCells('A2:I2')->setCellValue('A2', "DATA REQUIRED FOR INSURANCE SCHEME");
          

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
            $event->sheet->setCellValue('D3', "ACTIVE TYPE");
            $event->sheet->setCellValue('E3', "DATE OF BIRTH");
            $event->sheet->setCellValue('F3', "BASIC SALARY");
            $event->sheet->setCellValue('G3', "GROSS SALARY");
            $event->sheet->setCellValue('H3', "DEPENDENT NAME");
            $event->sheet->setCellValue('I3', "DEPENDENT DOB");
            $i=4;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":I".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('D'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('D'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->getDelegate()->getStyle('H'.$i.":I".$i)->getAlignment()->setWrapText(true);
            $event->sheet->getColumnDimension('H')->setWidth(20);
            $event->sheet->getColumnDimension('H')->setWidth(20);
            $event->sheet->getColumnDimension('I')->setWidth(15);
            $event->sheet->getColumnDimension('I')->setWidth(15);
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, @$val->desg_name);
            $event->sheet->setCellValue('D'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetModifydate(@$val->DOB));
            $event->sheet->setCellValue('F'.$i, @$val->new_basic_pay);
            $event->sheet->setCellValue('G'.$i, "");
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetDepend(@$val->emp_no,"NAME"));
            $event->sheet->setCellValue('I'.$i, $this->Healper->GetDepend(@$val->emp_no,"DOB"));
            $i++;
            }
        },
    ];
    }
}
