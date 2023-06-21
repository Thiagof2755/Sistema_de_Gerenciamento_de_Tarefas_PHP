<?php 
namespace bean;

class TaskBean {
    public $id;
    public $employeeId;
    public $title;
    public $description;
    public $dueDate;
    public $status;


    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
?>
