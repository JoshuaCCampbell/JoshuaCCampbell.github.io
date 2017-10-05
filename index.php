<?php
  // Get the correct page number
  $page_num = $_GET['page'];
  if($page_num == null)
  {
    $page_num = 1;
  }
  else if($page_num < 1)
  {
    $page_num = 1;
  }


  $page_results = ($page_num * 25) - 25;

  // base64 encoding to prevent screen lookers
  $dbpass = base64_decode("aW5ldDIwMDU=");
  // Use the connection file then connect
  require("mysql_connect.php");
  $conn = db_connect("localhost", "root", $dbpass, "employees");

  // Select users and limit 25 to a page
  $select_emps_query = "
    SELECT
      emp_no,
      birth_date,
      first_name,
      last_name,
      gender,
      hire_date
    FROM
      employees
    LIMIT $page_results, 25";

  // Execute query and build results list
  $results = mysqli_query($conn, $select_emps_query);

  // Throw an error if results can't be populated
  if(!$results)
  {
    die("Error fetching records from database with error");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Employee Records</title>
  </head>
  <body>
    <section id="main_body">
      <article id="main_results_table">
        <table>
          <thead>
            <tr>
              <th>Employee Number</th>
              <th>Birth Date</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Gender</th>
              <th>Hire Date</th>
            </tr>
          </thead>
          <tbody>
          <?php while($row = mysqli_fetch_assoc($results)) { ?>
            <tr>
              <td class="col1" id="<?php echo $row['emp_no'] ?>">
                <?php echo $row['emp_no'] ?>
              </td>
              <td class="col2" id="<?php echo $row['emp_no'] ?>">
                <?php echo $row['birth_date'] ?>
              </td>
              <td class="col3" id="<?php echo $row['emp_no'] ?>">
                <?php echo $row['first_name']; ?>
              </td>
              <td class="col4" id="<?php echo $row['emp_no'] ?>">
                <?php echo $row['last_name']; ?>
              </td>
              <td class="col5" id="<?php echo $row['emp_no'] ?>">
                <?php echo $row['gender']; ?>
              </td>
              <td class="col6" id="<?php echo $row['emp_no'] ?>">
                <?php echo $row['hire_date']; ?>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        <span>
          <a href="index.php?page=<?php echo $page_num - 1 ?>">Prev Page</a>
          <a href="index.php?page=<?php echo $page_num + 1 ?>">Next Page</a>
        </span>
      </article>
    </section>
  </body>
</html>