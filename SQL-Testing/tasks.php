<?php
//require_once '..includes/database.php';
//
//$day = isset($_GET['day']) ? (int) $_GET['day'] : (int) date('N');
//$isAjax = isset($_GET['ajax']) && $_GET['ajax'] == '1';
//
//// Fetch tasks
//$sql = "SELECT id, task_name, day, time FROM robot_tasks WHERE day = ? ORDER BY time";
//$stmt = mysqli_prepare($db, $sql);
//mysqli_stmt_bind_param($stmt, 'i', $day);
//mysqli_stmt_execute($stmt);
//$result = mysqli_stmt_get_result($stmt);
//
//if ($isAjax) {
//    if (mysqli_num_rows($result) === 0) {
//        echo '<div class="notification is-warning">No tasks scheduled for this day.</div>';
//    } else {
//        echo '<table class="table is-fullwidth is-striped">
//                <thead>
//                  <tr>
//                    <th>ID</th>
//                    <th>Task Name</th>
//                    <th>Time</th>
//                    <th>Edit</th>
//                    <th>Delete</th>
//                  </tr>
//                </thead>
//            <tbody>';
//        while ($row = mysqli_fetch_assoc($result)) {
//            echo '<tr>
//                    <td>' . (int)$row['id'] . '</td>
//                    <td>' . htmlspecialchars($row['task_name']) . '</td>
//                    <td>' . htmlspecialchars($row['time']) . '</td>
//                    <td><a class="button is-small is-info" href="edit.php?id=' . urlencode($row['id']) . '">Edit</a></td>
//                    <td><a class="button is-small is-danger" href="delete.php?id=' . urlencode($row['id']) . '">Delete</a></td>
//                  </tr>';
//        }
//        echo '</tbody></table>';
//    }
//
//    exit; // Belangrijk! Stop verdere HTML output voor AJAX
//}