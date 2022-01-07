<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;
use App\Http\Controllers\Controller;
use App\Services\ExcelToCollection;
use App\Services\ExtractHeaders;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    public $import = [];
    public function __construct()
    {
        $headers = [
            'Name',
            'Email',
            'Number',
            'Address'
        ];
        $this->import = config('importexcel.tables.import');
    }
    public function index(DatabaseService $databaseService)
    {
        $headers = [
            'Name',
            'Email',
            'Number',
            'Address'
        ];
        $tables = $databaseService->tables();
        return view('import', compact('tables', 'headers'));
    }

    public function getColumns(Request $request, DatabaseService $databaseService)
    {
        return $databaseService->tableSchema($request->table);
    }

    public function store(Request $request)
    {
        $importData = collect();
        $data = $request->all();
        list('excel' => $excel, 'table' => $table, 'column' => $column) = $data['import'];
        foreach ($excel as $key => $value) {
            $importData->push([
                'excel_colmun' => $value,
                'table_name' => $table[$key],
                'table_colmun' => $column[$key]
            ]);
        }
        $this->import($importData);
    }

    public function import(\Illuminate\Support\Collection $data)
    {
        foreach ($this->import as $key => $value) {
            $this->generateSQLToImport($data->where('table_name', $value), $value);
        }
    }

    /**
     * This will generate the SQL query responsible to import data into databse.
     *
     * @param \Illuminate\Support\Collection $data
     * @param string $table Table Name
     * @return void
     */
    public function generateSQLToImport(\Illuminate\Support\Collection $data, string $table)
    {
        if ($data->isNotEmpty()) {
            dd(
                $this->getExcelHeader('sampleimport.xlsx'),
                $this->readExcelAndConvertToCollection(public_path('sampleimport.xlsx')),
                $this->getTableColumnsToBeImported($data)
            );
        }
    }

    /**
     * This will pluck all the column names which will be imported.
     *
     * @param \Illuminate\Support\Collection $data
     * @return array
     */
    public function getTableColumnsToBeImported(\Illuminate\Support\Collection  $data): array
    {
        return $data->pluck('table_colmun')->toArray();
    }

    /**
     * Responsible for reading excel and converting it to laravel collection
     *
     * @param string $filename
     * @return \Illuminate\Support\Collection
     */
    public function readExcelAndConvertToCollection(string $filename)
    {
        return Excel::toCollection(new ExcelToCollection, $filename);
    }

    /**
     * Read the excel and return the Headers!
     *
     * @param string $filename
     * @return void
     */
    public function getExcelHeader(string $filename)
    {
        return (new ExtractHeaders)->toCollection($filename);
    }
}
