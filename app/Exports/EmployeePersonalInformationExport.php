<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeePersonalInformationExport implements FromCollection, WithHeadings, WithEvents
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
            $styleArray1 = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ];
            $event->sheet->getDelegate()->getStyle('A1:P1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:P1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:P1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:P1')->setCellValue('A1', "THE SAMAJ");  
            $event->sheet->setCellValue('Q1', "");
            $event->sheet->setCellValue('R1', "");
            $event->sheet->setCellValue('S1', "");

            $event->sheet->getDelegate()->getStyle('A2:P2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:P2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:P2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:P2')->setCellValue('A2', "EMPLOYEE PERSONAL INFORMATION DETAILS REPORT");
            $event->sheet->setCellValue('Q2', "");
            $event->sheet->setCellValue('R2', "");
            $event->sheet->setCellValue('S2', "");

            $event->sheet->getColumnDimension('J')->setWidth(40);
            $event->sheet->getColumnDimension('K')->setWidth(20);
            $event->sheet->getColumnDimension('L')->setWidth(20);
           
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
            $event->sheet->getDelegate()->getStyle('M3:P3')
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
            $event->sheet->setCellValue('Q3', "");
            $event->sheet->setCellValue('R3', "");
            $event->sheet->setCellValue('S3', "");
           

            $event->sheet->getDelegate()->getStyle('A4:P4')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A4:P4')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
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
            $event->sheet->getDelegate()->getStyle('M4:P4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');

            $event->sheet->setCellValue('A4', "SL NO");
            $event->sheet->setCellValue('B4', "EMPLOYEE CODE");
            $event->sheet->setCellValue('C4', "EMPLOYEE NAME");
            $event->sheet->setCellValue('D4', "DESIGNATION");
            $event->sheet->setCellValue('E4', "ACTIVE TYPE");
            $event->sheet->setCellValue('F4', "GENDER");
            $event->sheet->setCellValue('G4', "SPOUSE NAME");
            $event->sheet->setCellValue('H4', "FATHER'S NAME");
            $event->sheet->setCellValue('I4', "MOTHER'S NAME");
            $event->sheet->setCellValue('J4', "ADDRESS");
            $event->sheet->setCellValue('K4', "ACADEMIC");
            $event->sheet->setCellValue('L4', "TECHNICAL, PROFESSIONAL");
            $event->sheet->setCellValue('M4', "MARITAL STATUS");
            $event->sheet->setCellValue('N4', "BLOOD GROUP");
            $event->sheet->setCellValue('O4', "CONTACT NO");
            $event->sheet->setCellValue('P4', "E-MAIL");
            $event->sheet->setCellValue('Q4', "");
            $event->sheet->setCellValue('R4', "");
            $event->sheet->setCellValue('S4', "");
            $i=5;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":P".$i)->applyFromArray($styleArray);
            // $event->sheet->getDelegate()->getStyle('A'.$i.":P".$i)->applyFromArray($styleArray1);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('E'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('E'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->getDelegate()->getStyle('J'.$i.":L".$i)->getAlignment()->setWrapText(true);
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->employee_code);
            $event->sheet->setCellValue('C'.$i, @$val->emp_name);
            $event->sheet->setCellValue('D'.$i, @$val->desg_name);
            $event->sheet->setCellValue('E'.$i, $this->Healper->GetActiveType(@$val->active_type));
            if(@$val->sex=="M"){
                $event->sheet->setCellValue('F'.$i, "MALE");
            } elseif(@$val->sex=="F"){
                $event->sheet->setCellValue('F'.$i, "FEMALE");
            } else {
                $event->sheet->setCellValue('F'.$i,"");
            }
            $event->sheet->setCellValue('G'.$i, @$val->spouse_name);
            $event->sheet->setCellValue('H'.$i, @$val->father_name);
            $event->sheet->setCellValue('I'.$i, @$val->mother_name);
            $event->sheet->setCellValue('J'.$i, "Present- ".@$val->present_address1.", ".@$val->present_address2.", ".@$val->present_address3.". Premanent- ".@$val->PERM_ADDRESS1.", ".@$val->PERM_ADDRESS2.", ".@$val->PERM_ADDRESS3);
             
            $event->sheet->setCellValue('K'.$i, $this->Healper->GetQualification(@$val->emp_no,"ACADEMIC")); 
            $event->sheet->setCellValue('L'.$i, $this->Healper->GetQualification(@$val->emp_no,"TECHNICAL"));
            if(@$val->marital_status=="M"){
                $event->sheet->setCellValue('M'.$i, "Married");
            } elseif(@$val->marital_status=="U"){
                $event->sheet->setCellValue('M'.$i, "UnMarried");
            } else {
                $event->sheet->setCellValue('M'.$i, "");
            }
            $event->sheet->setCellValue('N'.$i, @$val->blood_group);
            $event->sheet->setCellValue('O'.$i, @$val->ph_no);
            $event->sheet->setCellValue('P'.$i, @$val->email);
            $event->sheet->setCellValue('Q'.$i, "");
            $event->sheet->setCellValue('R'.$i, "");
            $event->sheet->setCellValue('S'.$i, "");
           
            $i++;
            }
        },
    ];
    }
}

