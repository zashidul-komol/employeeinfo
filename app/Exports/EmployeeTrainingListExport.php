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
use App\Models\EmployeeTrainingHistory;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeTrainingListExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EmployeeTrainingHistory::with([
            'employee:id,name,polar_id',
        ])
        ->orderBy('employee_id', 'ASC')
        ->orderBy('start_date', 'ASC')
        ->get()
        ->map(function ($data) {

            return [
                'Employee Name' =>
                    $data->employee->name ?? '',

                'Polar ID' =>
                    $data->employee->polar_id ?? '',

                'Training Name' =>
                    $data->training_name ?? '',

                'Training Type' =>
                    $data->training_type ?? '',

                'Training Provider' =>
                    $data->training_provider ?? '',

                'Start Date' =>
                    $data->start_date ?? '',

                'End Date' =>
                    $data->end_date ?? '',

                'Duration' =>
                    $data->duration ?? '',

                'Training Location' =>
                    $data->training_location ?? '',

                'Status' =>
                    $data->status ?? '',

                'Certificate' =>
                    $data->certificate_path ? 'Yes' : 'No',

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
            'Training Name',
            'Training Type',
            'Training Provider',
            'Start Date',
            'End Date',
            'Duration',
            'Training Location',
            'Status',
            'Certificate',
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