<?php
require('./event-handler/index.php');
$evHandler = new EventHandler();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Exam 🦴</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="icon" type="image/png" href="./assets/favico.jpg">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#ffad1f;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Actions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/er">E/R</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <form action="/" method="POST">
      <div class="container pt-3">
        <div class="row">
          <div class="col">
            <label for="action">Select an action</label>
            <div class="form-inline">
              <div class="form-group mr-3">
                <select class="form-control" id="action" name="action" onchange="onSelectAction(this.value)">
                  <option value="create_tables">Create Tables</option>
                  <option value="populate_tables">Populate Tables</option>
                  <option value="delete_tables">Delete Tables</option>
                  <option value="query">Query</option>
                </select>
              </div>
              <div id="selectQueryDiv"></div>
              <div class="form-group">
                <button class="btn btn-outline-secondary mr-3" type="submit">Execute</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col pt-3">
            <div id="insertQueryDiv"></div>
            <?php
            if (sizeof($_POST) > 0) {
              $action = $_POST['action'];
              switch ($action) {
                case "create_tables":
                  $evHandler->onCreateTables();
                  break;
                case "populate_tables":
                  $evHandler->onPopulateTables(500);
                  break;
                case "query":
                  $sql = $_POST["query"];
                  echo "
                  <div class='p-3 mb-3' style='white-space:pre-line; border: 1px solid #f4f4f4; background-color: #f0efed'>
                    <h6>Selected query</h6>
                    <code>${sql}</code>
                  </div>
                ";
                  $evHandler->onExecuteQuery($sql);
                  break;
                case "delete_tables":
                  $evHandler->onDeleteTables();
              }
            } else {
              $sql = "SELECT * FROM actor";
              echo "
              <div class='p-3 mb-3' style='white-space:pre-line; border: 1px solid #f4f4f4; background-color: #f0efed'>
                <h6>Defauld query</h6>
                <code>${sql}</code>
              </div>
            ";
              $evHandler->onExecuteQuery($sql);
            }
            ?>
          </div>
        </div>
      </div>
    </form>
  </main>
  <footer class="text-muted">
    <div class="container">
      <hr>
      <p>Author: Dodesini Giorgio</p>
    </div>
  </footer>
  <script src="./js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>