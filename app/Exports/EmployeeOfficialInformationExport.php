<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeOfficialInformationExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->getDelegate()->getStyle('A1:S1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $event->sheet->getDelegate()->getStyle('A1:S1')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A1:S1')->getFont()->setSize(16);  
            $event->sheet->mergeCells('A1:S1')->setCellValue('A1', "THE SAMAJ");  

            $event->sheet->getDelegate()->getStyle('A2:S2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:S2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:S2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:S2')->setCellValue('A2', "EMPLOYEE OFFICIAL INFORMATION DETAILS REPORT");

            $event->sheet->getDelegate()->getStyle('A3:S3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:S3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:S3')
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
            $event->sheet->setCellValue('G3', "EMPLOYEE TYPE");
            $event->sheet->setCellValue('H3', "EMPLOYEE CATEGORY");
            $event->sheet->setCellValue('I3', "GRADE");
            $event->sheet->setCellValue('J3', "UAN");
            $event->sheet->setCellValue('K3', "ESI NO");
            $event->sheet->setCellValue('L3', "PAN NO");
            $event->sheet->setCellValue('M3', "BANK A/C NO");
            $event->sheet->setCellValue('N3', "DOB");
            $event->sheet->setCellValue('O3', "DOJ");
            $event->sheet->setCellValue('P3', "PROB. START DATE");
            $event->sheet->setCellValue('Q3', "PROB. END DATE");
            $event->sheet->setCellValue('R3', "DATE OF CONFIRMATION");
            $event->sheet->setCellValue('S3', "DATE OF RETIREMENT");
            $i=4;
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":S".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('F'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A") {
                $event->sheet->getDelegate()->getStyle('F'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->getDelegate()->getStyle('H'.$i)->getAlignment()->setWrapText(true);
            $event->sheet->getDelegate()->getStyle('P'.$i.":Q".$i)->getAlignment()->setWrapText(true);
            $event->sheet->getColumnDimension('P')->setWidth(15);
            $event->sheet->getColumnDimension('Q')->setWidth(15);
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->employee_code);
            $event->sheet->setCellValue('C'.$i, @$val->emp_name);
            $event->sheet->setCellValue('D'.$i, @$val->desg_name);
            $event->sheet->setCellValue('E'.$i, @$val->dept_name);
            $event->sheet->setCellValue('F'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('G'.$i, $this->Healper->GetType(@$val->emp_type));
            $event->sheet->setCellValue('H'.$i, @$val->category_name);
            $event->sheet->setCellValue('I'.$i, @$val->pay_grade_code);
            $event->sheet->setCellValue('J'.$i, @$val->UAN);
            $event->sheet->setCellValue('K'.$i, @$val->esi_ac_no);
            $event->sheet->setCellValue('L'.$i, @$val->pan_no);
            $event->sheet->setCellValue('M'.$i, @$val->bank_ac_no);
            $event->sheet->setCellValue('N'.$i, $this->Healper->GetModifydate(@$val->DOB));
            $event->sheet->setCellValue('O'.$i, $this->Healper->GetModifydate(@$val->DOJ));
            $event->sheet->setCellValue('P'.$i, $this->Healper->Emp_probation(@$val->emp_no,"START"));
            $event->sheet->setCellValue('Q'.$i, $this->Healper->Emp_probation(@$val->emp_no,"END"));
            $event->sheet->setCellValue('R'.$i, $this->Healper->GetModifydate(@$val->confirm_date));
            $event->sheet->setCellValue('S'.$i, $this->Healper->GetModifydate(@$val->retirement_date));
            $i++;
            }
        },
    ];
    }
}
