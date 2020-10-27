<?php

namespace App\Repositories;

use App\Models\BaseModel;
use RuntimeException;

abstract class BaseRepository
{
    protected BaseModel $model;

    public function __construct()
    {
        $this->model = $this->buildModel();
    }

    protected function buildModel(): BaseModel
    {
        $model = $this->getModelResource();

        if (!class_exists($model))
            throw new RuntimeException("Model: {$model} is not defined in repository");

        return new $model;
    }

    protected abstract function getModelResource(): string;
}
