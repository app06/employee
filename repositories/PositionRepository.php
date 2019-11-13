<?php

namespace app\repositories;

use app\models\Position;
use app\repositories\exceptions\NotFoundException;

class PositionRepository
{
    /**
     * @param $id
     * @return Position
     * @throws NotFoundException
     */
    public function find($id)
    {
        if (!$position = Position::findOne($id)) {
            throw new NotFoundException('Model not found.');
        }
        return $position;
    }

    public function add(Position $position)
    {
        if (!$position->getIsNewRecord()) {
            throw new \RuntimeException('Adding existing model.');
        }
        if (!$position->insert(false)) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function save(Position $position)
    {
        if ($position->getIsNewRecord()) {
            throw new \RuntimeException('Saving new model.');
        }
        if ($position->update(false) === false) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function delete(Position $position)
    {
        if (!$position->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }
} 