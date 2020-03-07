<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Waavi\Translation\Models\Translation;

class TranslationExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $model;

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->model;
    }

    public function headings():array
    {
        return [
            trans('language.locale'),
            trans('translations.group'),
            trans('translations.item'),
            trans('translations.text')
        ];
    }
}
