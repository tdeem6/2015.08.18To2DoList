<?php
class Task
{
    private $description;
    private $due_date;
    private $category_id;
    private $id;

    function __construct($description, $id = null, $category_id, $due_date)
    {
        $this->description = $description;
        $this->id = $id;
        $this->category_id = $category_id;
        $this->due_date = $due_date;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setDueDate($new_due_date)
    {
        $this->due_date = (string) $new_due_date;
    }

    function getDueDate()
    {
        return $this->due_date;
    }

    function getId()
    {
        return $this->id;
    }

    function getCategoryId()
    {
        return $this->category_id;
    }

    function save()
    {
        $statement = $GLOBALS['DB']->exec("INSERT INTO tasks (description, category_id, due_date) VALUES ('{$this->getDescription()}', {$this->getCategoryId()}, '{$this->getDueDate()}'");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
        $tasks = array();
        foreach($returned_tasks as $task) {
            $description = $task['description'];
            $id = $task['id'];
            $category_id = $task['category_id'];
            $due_date = $category['due_date'];
            $new_task = new Task($description, $id, $category_id, $due_date);
            array_push($tasks, $new_task);
        }
        return $tasks;
    }

    static function find($search_id)
    {
        $found_task = null;
        $tasks = Task::getAll();
        foreach($tasks as $task) {
            $task_id = $task->getId();
            if($task_id == $search_id) {
                $found_task = $task;
            }
        }
        return $found_task;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM tasks;");
    }


}
 ?>
