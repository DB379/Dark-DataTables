<?php

namespace App\Controllers;

use App\Models\DataModel;

class DataController
{
    private DataModel $dataModel;

    public function __construct(DataModel $dataModel)
    {
        $this->dataModel = $dataModel;
    }

    /**
     * Loads the view for displaying the table.
     *
     * @return void
     */
    public function index(): void
    {
        require_once __DIR__ . '/../View/dataTables.php';
    }

    /**
     * Processes the AJAX request and returns JSON data.
     *
     * @return void
     */
    public function fetchData(): void
    {
        header('Content-Type: application/json');

        $params = $this->getRequestParameters();

        $totalRecords   = $this->dataModel->getTotalRecords();
        $totalFiltered  = $this->dataModel->getTotalFiltered($params['searchValue']);
        $data           = $this->dataModel->getData(
            $params['start'],
            $params['length'],
            $params['searchValue'],
            $params['orderBy'],
            $params['orderDir']
        );

        echo json_encode([
            "draw"            => $params['draw'],
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
    }

    /**
     * Retrieves and sanitizes parameters from the POST request.
     *
     * @return array
     */
    private function getRequestParameters(): array
    {
        $draw        = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
        $start       = isset($_POST['start']) ? intval($_POST['start']) : 0;
        $length      = isset($_POST['length']) ? intval($_POST['length']) : 10;
        $searchValue = isset($_POST['search']['value']) ? trim($_POST['search']['value']) : '';

        $orderColumn = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
        $orderDir    = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'city',
            5 => 'age'
        ];

        return [
            'draw'        => $draw,
            'start'       => $start,
            'length'      => $length,
            'searchValue' => $searchValue,
            'orderBy'     => $columns[$orderColumn] ?? 'id',
            'orderDir'    => $orderDir
        ];
    }
}
