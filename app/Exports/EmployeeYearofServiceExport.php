<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeYearofServiceExport implements FromCollection, WithHeadings, WithEvents
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


            $event->sheet->getDelegate()->getStyle('A2:N2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:N2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:N2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:N2')->setCellValue('A2', "EMPLOYEE YEAR OF SERVICE, QUALIFICATION AND PAY GRADE DETAILS REPORT");
            $event->sheet->setCellValue('O2', "");
            $event->sheet->setCellValue('P2', "");



            $event->sheet->getDelegate()->getStyle('A3:P3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:P3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:J3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('K3:L3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('c8e0d8');
            $event->sheet->getDelegate()->getStyle('M3:N3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A3', "");
            $event->sheet->setCellValue('B3', "");
            $event->sheet->setCellValue('C3', "");
            $event->sheet->setCellValue('D3', "");
            $event->sheet->setCellValue('E3', "");
            $event->sheet->setCellValue('F3', "");
            $event->sheet->setCellValue('G3', "");
            $event->sheet->setCellValue('H3', "");
            $event->sheet->setCellValue('I3', "");
            $event->sheet->setCellValue('J3', "");
            $event->sheet->mergeCells('K3:L3')->setCellValue('K3', "EDUCATION QUALIFICATION");  
            $event->sheet->setCellValue('M3', "");
            $event->sheet->setCellValue('N3', "");
            $event->sheet->setCellValue('O3', "");
            $event->sheet->setCellValue('P3', "");
            
           

            $event->sheet->getDelegate()->getStyle('A4:N4')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A4:N4')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A4:J4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('K4:L4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('faebd7');
            $event->sheet->getDelegate()->getStyle('M4:N4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A4', "SL NO");
            $event->sheet->setCellValue('B4', "EMPLOYEE NAME");
            $event->sheet->setCellValue('C4', "EMPLOYEE CODE");
            $event->sheet->setCellValue('D4', "DESIGNATION");
            $event->sheet->setCellValue('E4', "DEPARTMENT");
            $event->sheet->setCellValue('F4', "ACTIVE TYPE");
            $event->sheet->setCellValue('G4', "DATE OF BIRTH");
            $event->sheet->setCellValue('H4', "JOINING DATE");
            $event->sheet->setCellValue('I4', "DATE OF CONFIRMATION");
            $event->sheet->setCellValue('J4', "YEAR OF SERVICE");
            $event->sheet->setCellValue('K4', "ACADEMIC");
            $event->sheet->setCellValue('L4', "TECHNICAL/ PROFESSIONAL");
            $event->sheet->setCellValue('M4', "GRADE IN MAJITHIA WAGEBOARD");
            $event->sheet->setCellValue('N4', "REMARKS");
            $event->sheet->setCellValue('O4', "");
            $event->sheet->setCellValue('P4', "");
           
            $i=5;
            $event->sheet->getColumnDimension('K')->setWidth(20);
            $event->sheet->getColumnDimension('L')->setWidth(20);
            $event->sheet->getColumnDimension('N')->setWidth(20);
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":N".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('F'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('F'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->getDelegate()->getStyle('K'.$i.":L".$i)->getAlignment()->setWrapText(true);
            $event->sheet->getDelegate()->getStyle('N'.$i)->getAlignment()->setWrapText(true);

            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, @$val->employee_code);
            $event->sheet->setCellValue('D'.$i, @$val->desg_name);
            $event->sheet->setCellValue('E'.$i, @$val->dept_name);
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetModifydate(@$val->DOB));
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetModifydate(@$val->DOJ));
            $event->sheet->setCellValue('I'.$i, $this->Healper->GetModifydate(@$val->confirm_date));
            $event->sheet->setCellValue('J'.$i, $this->Healper->GetYearofService(@$val->DOJ,@$val->retirement_date));
            $event->sheet->setCellValue('K'.$i, $this->Healper->GetQualification(@$val->emp_no,"ACADEMIC")); 
            $event->sheet->setCellValue('L'.$i, $this->Healper->GetQualification(@$val->emp_no,"TECHNICAL"));
            $event->sheet->setCellValue('M'.$i, @$val->pay_grade_code);
            $event->sheet->setCellValue('N'.$i, $this->Healper->GetRemark(@$val->emp_no,"REMARK"));
            $event->sheet->setCellValue('O'.$i, "");
            $event->sheet->setCellValue('P'.$i, "");
            $i++;
            }
        },
    ];
    }
}
