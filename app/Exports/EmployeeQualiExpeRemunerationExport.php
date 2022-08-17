<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeQualiExpeRemunerationExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->getDelegate()->getStyle('A1:O1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:O1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:O1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:O1')->setCellValue('A1', "THE SAMAJ");  
            

            $event->sheet->getDelegate()->getStyle('A2:O2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:O2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:O2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:O2')->setCellValue('A2', "EMPLOYEES ADDRESS,QUALIFICATION,PAN,BANK A/C AND ANNUAL REMUNERATION DETAILS REPORT");
          

            $event->sheet->getDelegate()->getStyle("H3:K3")->getAlignment()->setWrapText(true);
            $event->sheet->getColumnDimension('H')->setWidth(20);
            $event->sheet->getColumnDimension('I')->setWidth(20);
            $event->sheet->getColumnDimension('J')->setWidth(20);
            $event->sheet->getColumnDimension('K')->setWidth(20);
           

            $event->sheet->getDelegate()->getStyle('A3:J3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:J3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:G3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('H3:I3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('c8e0d8');
            $event->sheet->getDelegate()->getStyle('J3:K3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('d8c5d4');
            $event->sheet->getDelegate()->getStyle('L3:O3')
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
            $event->sheet->mergeCells('H3:I3')->setCellValue('H3', "EDUCATIONAL QUALIFICATION");
            $event->sheet->mergeCells('J3:K3')->setCellValue('J3', "EXPERIENCE");  
            $event->sheet->setCellValue('L3', "");
            $event->sheet->setCellValue('M3', "");
            $event->sheet->setCellValue('N3', "");
            $event->sheet->setCellValue('O3', "");
          




            $event->sheet->getDelegate()->getStyle('A4:O4')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A4:O4')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle("H4:K4")->getAlignment()->setWrapText(true);
            $event->sheet->getDelegate()->getStyle('A4:G4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('H4:I4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('faebd7');
            $event->sheet->getDelegate()->getStyle('J4:K4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('dbf4d0');
            $event->sheet->getDelegate()->getStyle('L4:O4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            





            $event->sheet->setCellValue('A4', "SL NO");
            $event->sheet->setCellValue('B4', "EMPLOYEE NAME");
            $event->sheet->setCellValue('C4', "DESIGNATION");
            $event->sheet->setCellValue('D4', "DEPARTMENT");
            $event->sheet->setCellValue('E4', "DATE OF BIRTH");
            $event->sheet->setCellValue('F4', "DATE OF JOINING");
            $event->sheet->setCellValue('G4', "ACTIVE TYPE");
            $event->sheet->setCellValue('H4', "ACADEMIC");
            $event->sheet->setCellValue('I4', "TECHNICAL/ PROFESSIONAL");
            $event->sheet->setCellValue('J4', "NO. OF YEARS");
            $event->sheet->setCellValue('K4', "SECTOR");
            $event->sheet->setCellValue('L4', "BASIC SALARY");
            $event->sheet->setCellValue('M4', "ALLOWANCES");
            $event->sheet->setCellValue('N4', "GROSS SALARY");
            $event->sheet->setCellValue('O4', "NET SALARY");
            $i=5;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":G".$i)->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('J'.$i)->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('L'.$i.":O".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('G'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('G'.$i)->getFont()->getColor()->setARGB('0fd419');
            }  
            $event->sheet->getDelegate()->getStyle('H'.$i.":K".$i)->getAlignment()->setWrapText(true);
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, @$val->desg_name);
            $event->sheet->setCellValue('D'.$i, @$val->desg_name);
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetModifydate(@$val->DOB));
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetModifydate(@$val->DOJ));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetActiveType(@$val->active_type));  
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetQualification(@$val->emp_no,"ACADEMIC")); 
            $event->sheet->setCellValue('I'.$i, $this->Healper->GetQualification(@$val->emp_no,"TECHNICAL"));
            $event->sheet->setCellValue('J'.$i, $this->Healper->Emp_experience(@$val->emp_no,"YEAR"));
            $event->sheet->setCellValue('K'.$i, $this->Healper->Emp_experience(@$val->emp_no,"SECTOR"));
            $event->sheet->setCellValue('L'.$i, @$val->new_basic_pay);
            $event->sheet->setCellValue('M'.$i, @$val->spl_allow);
            $event->sheet->setCellValue('N'.$i, "");
            $event->sheet->setCellValue('O'.$i, "");
            $i++;
            }
        },
    ];
    }
}
