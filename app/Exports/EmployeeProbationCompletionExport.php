<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeProbationCompletionExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->getDelegate()->getStyle('A1:J1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:J1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:J1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:J1')->setCellValue('A1', "THE SAMAJ");  
            $event->sheet->setCellValue('K1', "");
            $event->sheet->setCellValue('L1', "");

            $event->sheet->getDelegate()->getStyle('A2:J2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:J2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:J2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:J2')->setCellValue('A2', "PROBATION COMPLETION REPORT");
            $event->sheet->setCellValue('K2', "");
            $event->sheet->setCellValue('L2', "");

            $event->sheet->getDelegate()->getStyle('A3:J3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:J3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:J3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A3', "SL NO");
            $event->sheet->setCellValue('B3', "EMPLOYEE CODE");
            $event->sheet->setCellValue('C3', "EMPLOYEE NAME");
            $event->sheet->setCellValue('D3', "DESIGNATION");
            $event->sheet->setCellValue('E3', "DEPARTMENT");
            $event->sheet->setCellValue('F3', "ACTIVE TYPE");
            $event->sheet->setCellValue('G3', "JOINING DATE");
            $event->sheet->setCellValue('H3', "EMPLOYEE CATEGORY");
            $event->sheet->setCellValue('I3', "BASIC PAY");
            $event->sheet->setCellValue('J3', "PROBATION END DATE");
            $event->sheet->setCellValue('K3', "");
            $event->sheet->setCellValue('L3', "");
            $i=4;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":J".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('F'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('F'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->employee_code);
            $event->sheet->setCellValue('C'.$i, @$val->emp_name);
            $event->sheet->setCellValue('D'.$i, $this->Healper->Getdesignation(@$val->desg_code));
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetDepartment(@$val->dept_no));
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetModifydate(@$val->DOJ));
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetCategory(@$val->catg));
            $event->sheet->setCellValue('I'.$i, @$val->new_basic_pay);
            $event->sheet->setCellValue('J'.$i, $this->Healper->GetModifydate(@$val->DOP));
            $event->sheet->setCellValue('K'.$i, "");
            $event->sheet->setCellValue('L'.$i, "");
            $i++;
            }
        },
    ];
    }
}
