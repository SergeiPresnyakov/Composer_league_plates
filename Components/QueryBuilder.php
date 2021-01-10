<?php
namespace Components;
use Aura\SqlQuery\QueryFactory;
use PDO;


class QueryBuilder
{
    private $pdo, $queryFactory;
    
    public function __construct()
    {
        $config = include '../config.php';
        $config = $config['database'];

        $this->pdo = new PDO(
            "mysql:host={$config['host']};
            dbname={$config['database']};
            charset={$config['charset']}",
            $config['username'],
            $config['password']
        );
        
        $this->queryFactory = new QueryFactory('mysql');
    }

    /**
     * Все записи из таблицы posts
     * 
     * $db = new QueryBuilder();
     * $posts = $db->getAll('posts');
     */
    public function getAll($table)
    {
        $select = $this->queryFactory->newSelect();

        $select
            ->cols(['*'])
            ->from($table);

        $statement = $this->pdo->prepare($select->getStatement());
        $statement->execute($select->getBindValues());

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Вставить новую запись в таблицу posts
     * 
     * $db = new QueryBuilder();
     * $db->insert(['title' => 'Some new title', 'posts']);
     */
    public function insert($data, $table)
    {
        $insert = $this->queryFactory->newInsert();

        $insert
            ->into($table)
            ->cols($data);

        $statement = $this->pdo->prepare($insert->getStatement());
        $isSuccessful = $statement->execute($insert->getBindValues());

        return $isSuccessful;
    }

    /**
     * Отредактировать запись с id = 10 в таблице posts
     * 
     * $db = new QueryBuilder();
     * $db->update(['title' => 'Corrected title'], 10, 'posts');
     */
    public function update($data, $id, $table)
    {
        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)
            ->cols($data)
            ->where('id = :id')
            ->bindValue('id', $id);

        $statement = $this->pdo->prepare($update->getStatement());
        $isSuccessful = $statement->execute($update->getBindValues());

        return $isSuccessful;
    }

    /**
     * Получить одну запись по id из таблицы posts
     * 
     * $db = new QueryBuilder();
     * $db->getOne('posts', 7);
     */
    public function getOne($table, $id)
    {
        $select = $this->queryFactory->newSelect();

        $select
            ->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $statement = $this->pdo->prepare($select->getStatement());
        $statement->execute($select->getBindValues());
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result[0];
    }
    
    /**
     * Удалить запись по id из таблицы posts
     * 
     * $db = new QueryBuilder();
     * $db->delete('posts', 10);
     */
    public function delete($table, $id)
    {
        $delete = $this->queryFactory->newDelete();

        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);
        
        $statement = $this->pdo->prepare($delete->getStatement());
        $isSuccessful = $statement->execute($delete->getBindValues());

        return $isSuccessful;
    }
}