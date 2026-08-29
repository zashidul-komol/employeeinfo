<?php
namespace App\Exports;
use App\Models\ChildDetail;
use App\Models\BusinessMeet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use App\Models\EmployeePromotionHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class EmployeePromotionListExport implements FromCollection, WithHeadings, WithColumnFormatting
    {
        public function collection()
        {
            return EmployeePromotionHistory::with([

                'employee:id,name,polar_id',

                'previousDesignation:id,title',
                'newDesignation:id,title',

                'previousDepartment:id,name',
                'newDepartment:id,name',

                'previousOfficeLocation:id,name',
                'newOfficeLocation:id,name',

                'previousReportingTo:id,name,polar_id',
                'newReportingTo:id,name,polar_id',

            ])
            ->orderBy('employee_id', 'ASC')
            ->orderBy('effective_date', 'ASC')
            ->get()
            ->map(function ($data) {

                return [

                    'Employee Name' =>
                        $data->employee->name ?? '',

                    'Polar ID' =>
                        $data->employee->polar_id ?? '',

                    'Year' =>
                        $data->year ?? '',

                    'Promotion Type' =>
                        $data->promotion_type ?? '',


                    // Department
                    'Previous Department' =>
                        $data->previousDepartment->name ?? '',

                    'New Department' =>
                        $data->newDepartment->name ?? '',


                    // Designation
                    'Previous Designation' =>
                        $data->previousDesignation->title ?? '',

                    'New Designation' =>
                        $data->newDesignation->title ?? '',


                    // Grade
                    'Previous Grade' =>
                        $data->previous_grade ?? '',

                    'New Grade' =>
                        $data->new_grade ?? '',


                    // Office Location
                    'Previous Office Location' =>
                        $data->previousOfficeLocation->name ?? '',

                    'New Office Location' =>
                        $data->newOfficeLocation->name ?? '',


                    // Reporting To
                    'Previous Reporting To' =>
                        $data->previousReportingTo->name ?? '',

                    'Prev. Reporting To Polar ID' =>
                        $data->previousReportingTo->polar_id ?? '',

                    'New Reporting To' =>
                        $data->newReportingTo->name ?? '',

                    'New Reporting To Polar ID' =>
                        $data->newReportingTo->polar_id ?? '',


                    // Date
                    'Effective Date' =>
                        $data->effective_date
                            ? Carbon::parse($data->effective_date)
                            : null,


                    'Promotion Reason' =>
                        $data->promotion_reason ?? '',

                    'Remarks' =>
                        $data->remarks ?? '',
                ];
            });
        }


        public function headings(): array
        {
            return [

                'Employee Name',
                'Polar ID',

                'Year',
                'Promotion Type',

                'Previous Department',
                'New Department',

                'Previous Designation',
                'New Designation',

                'Previous Grade',
                'New Grade',

                'Previous Office Location',
                'New Office Location',

                'Previous Reporting To',
                'Prev. Reporting To Polar ID',

                'New Reporting To',
                'New Reporting To Polar ID',

                'Effective Date',

                'Promotion Reason',
                'Remarks',
            ];
        }


        public function columnFormats(): array
        {
            return [
                'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            ];
        }
    


    /**
     * @var object $invoice
     */
    public function map($businessMeet): array
    {
       // $this->sl_no = $this->sl_no + 1;
        return [
            $businessMeet->employees->polar_id,
            $businessMeet->employees->name,
            $businessMeet->child_name,
            \Carbon\Carbon::parse($businessMeet->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years, %m months'),
            $businessMeet->gender,
             
        ];

    }

    /**
     * Description: Some coustom hook into events, The events will be activated by adding the WithEvents concern
     * @return array //return an array of events
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                 

                //inserts 1 new rows, right before row 1:
                //$event->sheet->getDelegate()->insertNewRowBefore(1, 1);

                //Set top row height:
                //$event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                //merge two or more cells together, to become one cell
                //$event->sheet->getDelegate()->mergeCells('A1:T1');

                //Set value to merge cells
                //$today = date("j F, Y");
                //Set value to merge cells
                //$event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\n Employee Lists.\n As On " . $today);

                //$cellRange = 'A2:T2';
                //$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                //Style to merge cells
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'FFA0A0A0',
                        ],
                        'endColor' => [
                            'argb' => 'FFFFFFFF',
                        ],
                    ],
                ];

                //apply style to merge cells
                //$event->sheet->getDelegate()->getStyle('A1:T1')->applyFromArray($styleArray);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'DDDDDDDD'],
                        ],
                    ],
                ];
                //apply style to Header cells
                $event->sheet->getDelegate()->getStyle('A1:T1')->applyFromArray($styleArray);

            },
        ];
    }
}

?>