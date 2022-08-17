<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeBasicePayppExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->getDelegate()->getStyle('A1:N1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:N1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:N1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:N1')->setCellValue('A1', "THE SAMAJ");  
            $event->sheet->setCellValue('O1', "");
            $event->sheet->setCellValue('P1', "");
            $event->sheet->setCellValue('Q1', "");

            $event->sheet->getDelegate()->getStyle('A2:N2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:N2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:N2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:N2')->setCellValue('A2', "EMPLOYEES BASIC PAY, PP1, PP2, SPL. ALLOWANCE & OTHER ALLOWANCE LIST");
            $event->sheet->setCellValue('O2', "");
            $event->sheet->setCellValue('P2', "");
            $event->sheet->setCellValue('Q2', "");
          

            $event->sheet->getDelegate()->getStyle('A3:N3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:N3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:N3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A3', "SL NO");
            $event->sheet->setCellValue('B3', "EMPLOYEE CODE");
            $event->sheet->setCellValue('C3', "EMPLOYEE NAME");
            $event->sheet->setCellValue('D3', "EMPLOYEE TYPE");
            $event->sheet->setCellValue('E3', "EMPLOYEE CATEGORY");
            $event->sheet->setCellValue('F3', "DESIGNATION");
            $event->sheet->setCellValue('G3', "DEPARTMENT");
            $event->sheet->setCellValue('H3', "ACTIVE TYPE");
            $event->sheet->setCellValue('I3', "PAY GRADE");
            $event->sheet->setCellValue('J3', "BASIC PAY/ CONT. SALARY");
            $event->sheet->setCellValue('K3', "PP_1");
            $event->sheet->setCellValue('L3', "PP_2");
            $event->sheet->setCellValue('M3', "SPL ALLOWANCE");
            $event->sheet->setCellValue('N3', "OTHER ALLOWANCE");
            $event->sheet->setCellValue('O3', "");
            $event->sheet->setCellValue('P3', "");
            $event->sheet->setCellValue('Q3', "");
            $i=4;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":N".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('H'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('H'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->employee_code);
            $event->sheet->setCellValue('C'.$i, @$val->emp_name);
            $event->sheet->setCellValue('D'.$i, $this->Healper->GetType(@$val->emp_type));
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetCategory(@$val->catg));
            $event->sheet->setCellValue('F'.$i, $this->Healper->Getdesignation(@$val->desg_code));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetDepartment(@$val->dept_no));
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('I'.$i, $this->Healper->GetPaygrade(@$val->pay_grade_code));
            if(@$val->emp_type=="CO"){
                $event->sheet->setCellValue('J'.$i, @$val->CONT_SAL);
            } else {
                $event->sheet->setCellValue('J'.$i, @$val->new_basic_pay);
            }
            $event->sheet->setCellValue('K'.$i, @$val->pp1);
            $event->sheet->setCellValue('L'.$i, @$val->pp2);
            $event->sheet->setCellValue('M'.$i, @$val->spl_allow);
            $event->sheet->setCellValue('N'.$i, @$val->conv_allow);
            $event->sheet->setCellValue('O'.$i, "");
            $event->sheet->setCellValue('P'.$i, "");
            $event->sheet->setCellValue('Q'.$i, "");
            $i++;
            }
        },
    ];
    }
}
