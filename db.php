<?php

      $conn = mysqli_connect("localhost", "root", "", "todays-task");
      if (!$conn) {
            die("Connection failed: ". mysqli_connect_error());
      }
      $sql = "SELECT * FROM super_admin";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["password"]. "<br>";
            }
            mysqli_free_result($result);
      } else {
            echo "
            ". mysqli_error($conn);
      }
      mysqli_close($conn);
      ?>