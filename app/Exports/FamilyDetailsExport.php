<?php
namespace App\Exports;
use App\Models\Employee;
use App\Models\ChildDetail;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class FamilyDetailsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $param;
    protected $sl_no = 0;

    public function __construct(int $param = 0) {
        $this->param = $param;
    }

    public function query() {

        $query = ChildDetail::with([
                'employees' => function ($q) {
                    return $q->select('*');
                },
                
            ])
           
            ->select(   'child_details.employee_id',
                        'child_details.child_name',
                        'designations.title as Designation',
                        'office_locations.name as location',
                        'family_details.wife_name as Spouse',
                        'child_details.date_of_birth'
                         
            )

            ->join('employees', 'employees.id', '=', 'child_details.employee_id')
            ->join('designations', 'designations.id', '=', 'employees.desig_id')
            ->join('office_locations', 'office_locations.id', '=', 'employees.office_loc_id')
            ->join('family_details', 'family_details.employee_id', '=', 'employees.id');

            
                
            //dd($query);   
            return $query;
            

    }

    public function headings(): array
    {

        return [
            'Grade',
            'Name',
            'Designation',
            'Office Location',
            'Spouse Name',
            'Child Name',
            'Child DOB',
            'Status'
           
        ];
    }

    /**
     * @var object $invoice
     */
    public function map($employee): array
    {
       // $this->sl_no = $this->sl_no + 1;
        return [
            $employee->employees->grade,
            $employee->employees->name ?? '',
            $employee->Designation,
            $employee->location,
            $employee->Spouse,
            $employee->child_name,
            $employee->date_of_birth,
            $employee->employees->status ?? ''
             
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