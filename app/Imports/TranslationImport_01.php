<?php
/*
 * https://docs.laravel-excel.com/3.1/imports/collection.html
 * https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html
 * https://topic.alibabacloud.com/a/laravel-5-uses-laravel-excel-to-import-and-font-colorredexportfont-excelcsv-font-colorredfilesfont_1_34_32676416.html
 */
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Waavi\Translation\Models\Translation;
use Waavi\Translation\Repositories\TranslationRepository;


class TranslationImport01 implements ToCollection, WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $locale = \App\Classes\Helper::remove_accents(strtolower(trans('language.locale')));
        $group = \App\Classes\Helper::remove_accents(strtolower(trans('translations.group')));
        $item = \App\Classes\Helper::remove_accents(strtolower(trans('translations.item')));
        $text = \App\Classes\Helper::remove_accents(trans('translations.text'));

        $model = new Translation();
        $repository = new TranslationRepository(new Translation(), app());

        foreach( $rows as $row )
        {
            $model = $model->where('locale', $row->get($locale))
                ->where('group', $row->get($group))
                ->where('item', $row->get($item));
            $trans = $model->first();

            if( !empty($trans) )
            {
                if( $trans->text !== $row->get($text) )
                {
                    $transText = $row->get($text);
                    if( empty($transText) )
                    {
                        $transText = '';
                    }

                    $repository->update($trans->id, $transText);
                }
            }
        }

    }

    public function headingRow():int
    {
        return 1;
    }
}
