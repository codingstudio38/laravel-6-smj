<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeQualiExperienceExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->mergeCells('A2:O2')->setCellValue('A2', "EMPLOYEE QUALIFICATION AND EXPERIENCE DETAILS REPORT");

            $event->sheet->getDelegate()->getStyle('A3:O3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:O3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:E3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('F3:J3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('c8e0d8');
            $event->sheet->getDelegate()->getStyle('K3:O3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('d8c5d4');
            $event->sheet->setCellValue('A3', "");
            $event->sheet->setCellValue('B3', "");
            $event->sheet->setCellValue('C3', "");
            $event->sheet->setCellValue('D3', "");
            $event->sheet->setCellValue('E3', "");
            $event->sheet->mergeCells('F3:J3')->setCellValue('F3', "EDUCATIONAL DETAILS"); 
            $event->sheet->mergeCells('K3:O3')->setCellValue('K3', "EXPERIENCE DETAILS");   
            
           

            $event->sheet->getDelegate()->getStyle('A4:O4')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A4:O4')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A4:J4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('F4:J4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('faebd7');
            $event->sheet->getDelegate()->getStyle('K4:O4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('dbf4d0');
            $event->sheet->setCellValue('A4', "SL NO");
            $event->sheet->setCellValue('B4', "EMPLOYEE NAME");
            $event->sheet->setCellValue('C4', "DESIGNATION");
            $event->sheet->setCellValue('D4', "DEPARTMENT");
            $event->sheet->setCellValue('E4', "ACTIVE TYPE");
            $event->sheet->setCellValue('F4', "ACADEMIC-DEGREE/ DETAILS");
            $event->sheet->setCellValue('G4', "PROFESSIONAL/TECHNICAL DEGREE/DETAILS");
            $event->sheet->setCellValue('H4', "BOARD/UNIVERSITY");
            $event->sheet->setCellValue('I4', "YEAR OF PASSING");
            $event->sheet->setCellValue('J4', "% OF MARK");
            $event->sheet->setCellValue('K4', "ORGANISATION NAME");
            $event->sheet->setCellValue('L4', "POSITION");
            $event->sheet->setCellValue('M4', "FROM DATE");
            $event->sheet->setCellValue('N4', "TO DATE");
            $event->sheet->setCellValue('O4', "SECTOR");
           
            $i=5;
            $event->sheet->getColumnDimension('F')->setWidth(20);
            $event->sheet->getColumnDimension('G')->setWidth(20);
            $event->sheet->getColumnDimension('H')->setWidth(20);
            $event->sheet->getColumnDimension('I')->setWidth(12);
            $event->sheet->getColumnDimension('J')->setWidth(12);
            $event->sheet->getColumnDimension('K')->setWidth(20);
            $event->sheet->getColumnDimension('L')->setWidth(20);
            $event->sheet->getColumnDimension('M')->setWidth(14);
            $event->sheet->getColumnDimension('N')->setWidth(14);
            $event->sheet->getColumnDimension('O')->setWidth(20);
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":O".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('E'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('E'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->getDelegate()->getStyle('F'.$i.":O".$i)->getAlignment()->setWrapText(true);

            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, @$val->desg_name);
            $event->sheet->setCellValue('D'.$i, @$val->dept_name);
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetQualification(@$val->emp_no,"ACADEMIC"));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetQualification(@$val->emp_no,"TECH"));
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetQualificationFildWise(@$val->emp_no,"institution"));
            $event->sheet->setCellValue('I'.$i, $this->Healper->GetQualificationFildWise(@$val->emp_no,"year_passing"));
            $event->sheet->setCellValue('J'.$i, $this->Healper->GetQualificationFildWise(@$val->emp_no,"mark_perc")); 
            $event->sheet->setCellValue('K'.$i, $this->Healper->Emp_experience(@$val->emp_no,"ORGANISATION"));
            $event->sheet->setCellValue('L'.$i, $this->Healper->Emp_experience(@$val->emp_no,"POSITION"));
            $event->sheet->setCellValue('M'.$i, $this->Healper->Emp_experience(@$val->emp_no,"START"));
            $event->sheet->setCellValue('N'.$i, $this->Healper->Emp_experience(@$val->emp_no,"END"));
            $event->sheet->setCellValue('O'.$i, $this->Healper->Emp_experience(@$val->emp_no,"SECTOR"));
            $i++;
            }
        },
    ];
    }
}
 