<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Http\Controllers\ExcelhealperFunction;

class EmployeeMasterDataReportExport implements FromCollection, WithHeadings, WithEvents
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
            $event->sheet->setCellValue('R1', "");
            $event->sheet->setCellValue('S1', "");


            $event->sheet->getDelegate()->getStyle('A2:N2')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A2:N2')->getFont()->setSize(13);
            $event->sheet->getDelegate()->getStyle('A2:N2')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f0f8ff');
            $event->sheet->mergeCells('A2:N2')->setCellValue('A2', "EMPLOYEE MASTER DATA REPORT");
            $event->sheet->setCellValue('O2', "");
            $event->sheet->setCellValue('P2', "");
            $event->sheet->setCellValue('Q2', "");
            $event->sheet->setCellValue('R2', "");
            $event->sheet->setCellValue('S2', "");


            $event->sheet->getDelegate()->getStyle('A3:N3')->applyFromArray($styleArray);
            $event->sheet->getDelegate()->getStyle('A3:N3')->getFont()->setSize(12)->getColor()->setARGB('1b55e2');
            $event->sheet->getDelegate()->getStyle('A3:N3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f5f3f3');
            $event->sheet->setCellValue('A3', "SL NO");
            $event->sheet->setCellValue('B3', "EMPLOYEE NAME");
            $event->sheet->setCellValue('C3', "ADDRESS");
            $event->sheet->setCellValue('D3', "CONTACT NO");
            $event->sheet->setCellValue('E3', "EMPLOYEE CODE");
            $event->sheet->setCellValue('F3', "DESIGNATION");
            $event->sheet->setCellValue('G3', "DEPARTMENT");
            $event->sheet->setCellValue('H3', "ACTIVE TYPE");
            $event->sheet->setCellValue('I3', "TYPE OF EMPLOYEE");
            $event->sheet->setCellValue('J3', "CATEGORY");
            $event->sheet->setCellValue('K3', "JOINING DATE");
            $event->sheet->setCellValue('L3', "DATE OF CONFIRMATION");
            $event->sheet->setCellValue('M3', "DATE OF BIRTH");
            $event->sheet->setCellValue('N3', "DATE OF RETIREMENT");
            $event->sheet->setCellValue('O3', "");
            $event->sheet->setCellValue('P3', "");
            $event->sheet->setCellValue('Q3', "");
            $event->sheet->setCellValue('R3', "");
            $event->sheet->setCellValue('S3', "");
            $i=4;
            $event->sheet->getColumnDimension('C')->setWidth(25);
            foreach($this->data as $key=>$val){
            $event->sheet->getDelegate()->getStyle('A'.$i.":N".$i)->applyFromArray($styleArray);
            if(@$val->active_type=="I"){
                $event->sheet->getDelegate()->getStyle('H'.$i)->getFont()->getColor()->setARGB('eb0000');
            } elseif(@$val->active_type=="A"){
                $event->sheet->getDelegate()->getStyle('H'.$i)->getFont()->getColor()->setARGB('0fd419');
            }
            $event->sheet->getDelegate()->getStyle('C'.$i)->getAlignment()->setWrapText(true);
            $event->sheet->setCellValue('A'.$i, $this->slno++);
            $event->sheet->setCellValue('B'.$i, @$val->emp_name);
            $event->sheet->setCellValue('C'.$i, "Present- ".@$val->present_address1.", ".@$val->present_address2.", ".@$val->present_address3.". Premanent- ".@$val->PERM_ADDRESS1.", ".@$val->PERM_ADDRESS2.", ".@$val->PERM_ADDRESS3);
            $event->sheet->setCellValue('D'.$i, @$val->ph_no);
            $event->sheet->setCellValue('E'.$i, @$val->employee_code);
            $event->sheet->setCellValue('F'.$i, @$val->desg_name);
            $event->sheet->setCellValue('G'.$i, @$val->dept_name);
            $event->sheet->setCellValue('H'.$i, $this->Healper->GetActiveType(@$val->active_type));
            $event->sheet->setCellValue('I'.$i, $this->Healper->GetType(@$val->emp_type));
            $event->sheet->setCellValue('J'.$i, @$val->category_name);
            $event->sheet->setCellValue('K'.$i, $this->Healper->GetModifydate(@$val->DOJ));
            $event->sheet->setCellValue('L'.$i, $this->Healper->GetModifydate(@$val->confirm_date));
            $event->sheet->setCellValue('M'.$i, $this->Healper->GetModifydate(@$val->DOB));
            $event->sheet->setCellValue('N'.$i, $this->Healper->GetModifydate(@$val->retirement_date));
            $event->sheet->setCellValue('O'.$i, "");
            $event->sheet->setCellValue('P'.$i, "");
            $event->sheet->setCellValue('Q'.$i, "");
            $event->sheet->setCellValue('R'.$i, "");
            $event->sheet->setCellValue('S'.$i, "");
            $i++;
            }
        },
    ];
    }
}
 