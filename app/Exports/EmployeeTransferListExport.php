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
use App\Models\EmployeeTransferHistory;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeTransferListExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EmployeeTransferHistory::with([
            'employee:id,name,polar_id',
            'previous_department:id,name',
            'new_department:id,name',
            'previous_office_location:id,name',
            'new_office_location:id,name',
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

                'Transfer Type' =>
                    $data->transfer_type ?? '',

                'Previous Department' =>
                    $data->previous_department->name ?? '',

                'New Department' =>
                    $data->new_department->name ?? '',

                'Previous Office Location' =>
                    $data->previous_office_location->name ?? '',

                'New Office Location' =>
                    $data->new_office_location->name ?? '',

                'Previous Reporting To' =>
                    $data->previousReportingTo->name ?? '',

                'New Reporting To' =>
                    $data->newReportingTo->name ?? '',

                'Effective Date' =>
                    $data->effective_date ?? '',

                'Transfer Reason' =>
                    $data->transfer_reason ?? '',

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
            'Transfer Type',
            'Previous Department',
            'New Department',
            'Previous Office Location',
            'New Office Location',
            'Previous Reporting To',
            'New Reporting To',
            'Effective Date',
            'Transfer Reason',
            'Remarks',
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