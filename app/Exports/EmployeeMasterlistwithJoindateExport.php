<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeMasterlistwithJoindateExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->getDelegate()->getStyle('A1:M1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:M1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:M1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:M1')->setCellValue('A1', "THE SAMAJ");  

            $event->sheet->getDelegate()->getStyle('A2:M2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:M2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:M2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:M2')->setCellValue('A2', "EMPLOYEES MASTER LIST(With Joining Period)");

            $event->sheet->getDelegate()->getStyle('A3:M3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:M3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:M3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A3', "SL NO");
            $event->sheet->setCellValue('B3', "EMPLOYEE NAME");
            $event->sheet->setCellValue('C3', "EMPLOYEE CODE");
            $event->sheet->setCellValue('D3', "DESIGNATION");
            $event->sheet->setCellValue('E3', "DEPARTMENT");
            $event->sheet->setCellValue('F3', "EMPLOYEE TYPE");
            $event->sheet->setCellValue('G3', "JOINING DATE");
            $event->sheet->setCellValue('H3', "DATE OF CONFIRMATION");
            $event->sheet->setCellValue('I3', "DATE OF BIRTH");
            $event->sheet->setCellValue('J3', "DATE OF RETIREMENT");
            $event->sheet->setCellValue('K3', "CONTRACT END DATE");
            $event->sheet->setCellValue('L3', "ACTIVE TYPE");
            $event->sheet->setCellValue('M3', "INACTIVE REASON");
            $i=4;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":M".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('L'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('L'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, @$val->employee_code);
            $event->sheet->setCellValue('D'.$i, $this->Healper->Getdesignation(@$val->desg_code));
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetDepartment(@$val->dept_no));
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetType(@$val->emp_type));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetModifydate(@$val->DOJ));
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetModifydate(@$val->confirm_date));
            $event->sheet->setCellValue('I'.$i, $this->Healper->GetModifydate(@$val->DOB));
            $event->sheet->setCellValue('J'.$i, $this->Healper->GetModifydate(@$val->retirement_date));
            $event->sheet->setCellValue('K'.$i, $this->Healper->GetContractEnddate(@$val->emp_no));
            $event->sheet->setCellValue('L'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('M'.$i, @$val->reason_desc);
            $i++;
            }
        },
    ];
    }
}
