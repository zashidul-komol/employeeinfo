<?php
namespace App\Exports;
use App\Models\DistributorUser;
use App\Models\Shop;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class ShopExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $param;
    protected $sl_no = 0;

    public function __construct(int $param = 0) {
        $this->param = $param;
    }

    public function query() {

        $query = Shop::select(
            'shops.id',
            'shops.outlet_name as outlet_name',
            'shops.proprietor_name',
            'shops.is_distributor',
            'shops.distributor_id',
            'shops.mobile',
            'division.name as divisionName',
            'district.name as districtName',
            'thana.name as thanaName',
            'region.name as regionName',
            'area.name as areaName',
            'shops.code',
            'shops.status',
            'distributor.outlet_name as distributor',
            'depots.name as depotName'
            )
            ->withCount('requisitions')
            ->where('shops.is_distributor', false)
            ->join('depots', 'depots.id', '=', 'shops.depot_id')
            ->leftJoin('zones as region', 'region.id', '=', 'shops.region_id')
            ->leftJoin('zones as area', 'area.id', '=', 'shops.area_id')
            ->leftJoin('locations as division', 'division.id', '=', 'shops.division_id')
            ->leftJoin('locations as district', 'district.id', '=', 'shops.district_id')
            ->leftJoin('locations as thana', 'thana.id', '=', 'shops.thana_id')
            ->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
            ->join('shops as distributor', 'distributor.id', '=', 'shops.distributor_id')
            ->whereIn('settlements.status',['continue','reserve'])
            ->where('distributor_users.user_id', auth()->user()->id);
            
            if (!$this->param) {
                $query->join('settlements', 'shops.id', '=', 'settlements.shop_id');
                
            } else {
                $query->join('settlements', 'shops.id', '!=', 'settlements.shop_id');
            }
            $query->groupBy('shops.id')->orderBy('shops.updated_at', 'desc');

            return $query;

    }

    public function headings(): array
    {

        return ['#',
            'Outlet',
            'Proprietor Name',
            'Distributor',
            'Mobile',
            'Depot',
            'Region',
            'Area',
            'Division',
            'District',
            'Thana',
        ];
    }

    /**
     * @var object $invoice
     */
    public function map($invoice): array
    {
        $this->sl_no = $this->sl_no + 1;
        return [
            $this->sl_no,
            $invoice->outlet_name,
            $invoice->proprietor_name,
            $invoice->distributor,
            (int) $invoice->mobile,
            $invoice->depotName ?? '',
            $invoice->regionName ?? '',
            $invoice->areaName ?? '',
            $invoice->divisionName ?? '',
            $invoice->districtName ?? '',
            $invoice->thanaName ?? '',
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

                if (!$this->param) {
                    $shopName = 'Injected DF Retailer';
                } else {
                    $shopName = 'Not Injected DF Retailer';
                }

                //inserts 1 new rows, right before row 1:
                $event->sheet->getDelegate()->insertNewRowBefore(1, 1);

                //Set top row height:
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                //merge two or more cells together, to become one cell
                $event->sheet->getDelegate()->mergeCells('A1:K1');

                //Set value to merge cells
                $today = date("j F, Y");
                //Set value to merge cells
                $event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\n$shopName Lists.\n As On " . $today);

                $cellRange = 'A2:K2';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

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
                $event->sheet->getDelegate()->getStyle('A1:K1')->applyFromArray($styleArray);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'DDDDDDDD'],
                        ],
                    ],
                ];
                //apply style to Header cells
                $event->sheet->getDelegate()->getStyle('A2:K2')->applyFromArray($styleArray);

            },
        ];
    }
}

?>