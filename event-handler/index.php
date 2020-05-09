<?php
  include('./mysql/index.php');

  class EventHandler
  {
    private $db;
    private $errorDivOpen = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    private $successDivOpen = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    private $closeAlertButton = '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>';
    private $divClose = '</div>';

    public function __construct()
    {
      $this->db = new MySQLDriver('./config.json');
    }

    public function onCreateTables()
    {
      try {
        $message = $this->db->createTables();
        echo $this->successDivOpen;
        echo $message;
        echo $this->closeAlertButton;
        echo $this->divClose;
      } catch (Exception $error) {
        echo $this->errorDivOpen;
        echo $error->getMessage();
        echo $this->divClose;
      }
    }
    public function onPopulateTables($numRows)
    {
      $this->db->populateTables($numRows);
      echo $this->successDivOpen;
      echo "Tables populated successfully";
      echo $this->closeAlertButton;
      echo $this->divClose;
    }

    public function onExecuteQuery($query)
    {
      try {
        $data = $this->db->executeQuery($query);
        $row1 = $data[0];
        $cols = array();
        echo "<table class='table table-striped table-bordered table-responsive-sm'>";
        echo "<thead>";
        echo "<tr>";
        foreach ($row1 as $col => $value) {
          echo "<th scope='col'>$col</th>";
          array_push($cols, $col);
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($data as $row) {
          echo "<tr>";
          foreach ($cols as $col) {
            echo "<td>{$row[$col]}</td>";
          }
          echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
      } catch (Exception $e) {
        echo $this->errorDivOpen;
        echo $e->getMessage();
        echo $this->divClose;
      }
    }

    public function onDeleteTables(){
      $this->db->deleteTables();
      echo $this->successDivOpen;
      echo "Tables deleted successfully";
      echo $this->closeAlertButton;
      echo $this->divClose;
    }
  }
?>