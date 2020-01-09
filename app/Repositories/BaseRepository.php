<?php

namespace App\Repositories;

abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    /**
     * Rekord keresése azonosító alapján
     *
     * @param $id
     * @param array $columns
     * @return mixed|void
     */
    public function findWithoutFail($id, $columns = ['*'])
    {
        try
        {
            return $this->find($id, $columns);
        }
        catch( Exception $e )
        {
            return;
        }
    }

    public function create(array $attributes)
    {
        // Have to skip presenter to get a model not some data
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        $model = parent::create($attributes);
        $this->skipPresenter($temporarySkipPresenter);

        $model = $this->updateRelations($model, $attributes);
        $model->save();

        return $this->parserResult($model);
    }

    public function update(array $attributes, $id)
    {
        // Have to skip presenter to get a model not some data
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        $model = parent::update($attributes, $id);
        $this->skipPresenter($temporarySkipPresenter);

        $model = $this->updateRelations($model, $attributes);
        $model->save();

        return $this->parserResult($model);
    }

    public function updateRelations($model, $attributes)
    {
        foreach ($attributes as $key => $val) {
            if (isset($model) &&
                method_exists($model, $key) &&
                is_a(@$model->$key(), 'Illuminate\Database\Eloquent\Relations\Relation')
            ) {
                $methodClass = get_class($model->$key($key));
                switch ($methodClass) {
                    case 'Illuminate\Database\Eloquent\Relations\BelongsToMany':
                        $new_values = array_get($attributes, $key, []);
                        if (array_search('', $new_values) !== false) {
                            unset($new_values[array_search('', $new_values)]);
                        }
                        $model->$key()->sync(array_values($new_values));
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\BelongsTo':
                        $model_key = $model->$key()->getForeignKey();
                        $new_value = array_get($attributes, $key, null);
                        $new_value = $new_value == '' ? null : $new_value;
                        $model->$model_key = $new_value;
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\HasOne':
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\HasOneOrMany':
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\HasMany':
                        $new_values = array_get($attributes, $key, []);
                        if (array_search('', $new_values) !== false) {
                            unset($new_values[array_search('', $new_values)]);
                        }

                        list($temp, $model_key) = explode('.', $model->$key($key)->getForeignKey());

                        foreach ($model->$key as $rel) {
                            if (!in_array($rel->id, $new_values)) {
                                $rel->$model_key = null;
                                $rel->save();
                            }
                            unset($new_values[array_search($rel->id, $new_values)]);
                        }

                        if (count($new_values) > 0) {
                            $related = get_class($model->$key()->getRelated());
                            foreach ($new_values as $val) {
                                $rel = $related::find($val);
                                $rel->$model_key = $model->id;
                                $rel->save();
                            }
                        }
                        break;
                }
            }
        }

        return $model;
    }

    public function withTrashed()
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->withTrashed();

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($result);
    }

    public function onlyTrashed()
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->onlyTrashed();

        $this->resetModel();
        $this->resetScope();

        return  $this->parserResult($results);
    }

    public function where($column, $operator, $value)
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->where($column, $operator, $value);

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($results);
    }

    /**
     * @param $table
     * @param $first
     * @param null $operator
     * @param null $second
     * @param string $type
     * @param bool $where
     * @return a
     * @throws
     */
    public function join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->join($table, $first, $operator, $second, $type, $where);

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($results);
    }

    public function count()
    {
        return $this->count();
    }

    public function toJson()
    {
        $a = $this->get()->toJson();
        dd($a);
    }
}