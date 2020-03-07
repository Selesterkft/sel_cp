<?php

namespace App\Imports;

use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Waavi\Translation\Models\Translation;

class TranslationImport implements ToModel, WithHeadingRow
{
    protected $data, $locale, $group, $item, $text;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * TranslationImport constructor.
     * @param $data
     */
    public function __construct()
    {
        $this->locale = \App\Classes\Helper::remove_accents(strtolower(trans('language.locale')));
        $this->group = \App\Classes\Helper::remove_accents(strtolower(trans('translations.group')));
        $this->item = \App\Classes\Helper::remove_accents(strtolower(trans('translations.item')));
        $this->text = \App\Classes\Helper::remove_accents(trans('translations.text'));
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        if($row[$this->text] == null){ $row[$this->text] = ''; }

        $trans = Translation::where('locale', $row[$this->locale])
            ->where('group', $row[$this->group])
            ->where('item', $row[$this->item])
            ->first();

        if( !empty($trans) && $trans['text'] !== $row[$this->text] )
        {
            $data = [
                'id' => $trans['id'],
                'locale' => $row[$this->locale],
                'group' => $row[$this->group],
                'item' => $row[$this->item],
                'text' => $row[$this->text],
            ];

            $trans->fill($data);

            $this->data[] = $trans;
        }
    }

    public function headingRow():int
    {
        return 1;
    }
}
