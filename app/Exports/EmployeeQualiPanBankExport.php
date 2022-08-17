<?php
 
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeQualiPanBankExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->setCellValue('M1', "");
            $event->sheet->setCellValue('N1', "");
            

            $event->sheet->getDelegate()->getStyle('A2:J2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:J2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:J2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:J2')->setCellValue('A2', "EMPLOYEES ADDRESS,QUALIFICATION,PAN,BANK A/C AND ANNUAL REMUNERATION DETAILS REPORT");
            $event->sheet->setCellValue('K2', "");
            $event->sheet->setCellValue('L2', "");
            $event->sheet->setCellValue('M2', "");
            $event->sheet->setCellValue('N2', "");
          

            $event->sheet->getDelegate()->getStyle("D4:J4")->getAlignment()->setWrapText(true);
            $event->sheet->getColumnDimension('D')->setWidth(20);
            $event->sheet->getColumnDimension('E')->setWidth(20);
            $event->sheet->getColumnDimension('F')->setWidth(20);
            $event->sheet->getColumnDimension('G')->setWidth(20);
            $event->sheet->getColumnDimension('H')->setWidth(20);
            $event->sheet->getColumnDimension('I')->setWidth(20);
            $event->sheet->getColumnDimension('J')->setWidth(20);


            $event->sheet->getDelegate()->getStyle('A3:J3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:J3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:E3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('F3:G3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('c8e0d8');
            $event->sheet->getDelegate()->getStyle('H3:J3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A3', "");
            $event->sheet->setCellValue('B3', "");
            $event->sheet->setCellValue('C3', "");
            $event->sheet->setCellValue('D3', "");
            $event->sheet->setCellValue('E3', "");
            $event->sheet->mergeCells('F3:G3')->setCellValue('F3', "EDUCATIONAL QUALIFICATION");  
            $event->sheet->setCellValue('H3', "");
            $event->sheet->setCellValue('I3', "");
            $event->sheet->setCellValue('J3', "");
            $event->sheet->setCellValue('K3', "");
            $event->sheet->setCellValue('L3', "");
            $event->sheet->setCellValue('M3', "");
            $event->sheet->setCellValue('N3', "");




            $event->sheet->getDelegate()->getStyle('A4:J4')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A4:J4')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A4:E4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->getDelegate()->getStyle('F4:G4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('faebd7');
            $event->sheet->getDelegate()->getStyle('H4:J4')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');





            $event->sheet->setCellValue('A4', "SL NO");
            $event->sheet->setCellValue('B4', "EMPLOYEE NAME");
            $event->sheet->setCellValue('C4', "ACTIVE TYPE");
            $event->sheet->setCellValue('D4', "ADDRESS ALONG WITH CONTACT NO. IF AVAILABLE");
            $event->sheet->setCellValue('E4', "DESIGNATION AND NATURE OF WORK PERFORMED");
            $event->sheet->setCellValue('F4', "ACADEMIC");
            $event->sheet->setCellValue('G4', "TECHNICAL/ PROFESSIONAL");
            $event->sheet->setCellValue('H4', "PERMANENT ACCOUNT NUMBER(PAN)");
            $event->sheet->setCellValue('I4', "AMOUNT OF SALARY/ REMUNERATION PAID DURING THE YEAR");
            $event->sheet->setCellValue('J4', "ACCOUNT NO. AND BANK ADDRESS OF THE EMPLOYEE IN WHICH SALARY/ REMUNERATION DEPOSITED");
            $event->sheet->setCellValue('K4', "");
            $event->sheet->setCellValue('L4', "");
            $event->sheet->setCellValue('M4', "");
            $event->sheet->setCellValue('N4', "");
            $i=5;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":I".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('C'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('C'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->getDelegate()->getStyle('D'.$i.":J".$i)->getAlignment()->setWrapText(true);
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('D'.$i, @$val->present_address1.", ".@$val->present_address2.", ".@$val->present_address3);
            $event->sheet->setCellValue('E'.$i, @$val->desg_name);
             
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetQualification(@$val->emp_no,"ACADEMIC")); 
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetQualification(@$val->emp_no,"TECHNICAL"));
            $event->sheet->setCellValue('H'.$i, @$val->pan_no);
            $event->sheet->setCellValue('I'.$i, @$val->pay_scale);
            $event->sheet->setCellValue('J'.$i, "ACC NO- ".@$val->bank_ac_no.", BANK NAME- ".@$val->bank_name.", IFSC CODE- ".@$val->ifsc_code.", ADDRESS- ".$val->addrerss);
            $event->sheet->setCellValue('K'.$i, "");
            $event->sheet->setCellValue('L'.$i, "");
            $event->sheet->setCellValue('M'.$i, "");
            $event->sheet->setCellValue('N'.$i, "");
            $i++;
            }
        },
    ];
    }
} 
