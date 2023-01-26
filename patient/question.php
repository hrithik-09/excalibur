<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session = $_SESSION['patientSession'];
$res = mysqli_query($con, "SELECT * FROM patient WHERE icPatient=" . $session);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Question Asked</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="appointment.php">Welcome
            <?php echo $userRow['patientFirstName'] . ' ' . $userRow['patientLastName']; ?>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                    <li class="nav-item">
							<a class="nav-link" aria-current="page" href="../index.php">
								<span data-feather="home" class="align-text-bottom"></span>
								Home
							</a>
						</li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="patient.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">
                                <span data-feather="list" class="align-text-bottom"></span>
                                Appointment
                            </a>
                        </li>
                        <li class="nav-item">
							<a class="nav-link" href="bed.php">
								<span data-feather="inbox" class="align-text-bottom"></span>
								Bed Availability
							</a>
						</li>
                        <li class="nav-item">
                            <a class="nav-link active" href="question.php">
                                <span data-feather="help-circle" class="align-text-bottom"></span>
                                Questions Asked
                            </a>
                        </li>
                    </ul>
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase">
                        <span>More options</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle" class="align-text-bottom"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                <span data-feather="user" class="align-text-bottom"></span>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php?patientId=<?php echo $userRow2['icPatient']; ?>">
                                <span data-feather="dollar-sign" class="align-text-bottom"></span>
                                Subscription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="patientlogout.php?logout">
                                <span data-feather="log-out"></span>
                                Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- navigation end -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Questions Asked</h1>
                </div>
                <h2 class="my-4">Dear <?php echo $userRow['patientFirstName']; ?>
                    <?php echo $userRow['patientLastName']; ?></h2>
                <div class="col-md-12 col-sm-9  user-wrapper">
                    <div class="description">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="container my-4" id="ques">
                                    <h2 class="text-center my-4"> List of your question asked</h2>
                                    <div class="row my-4">
                                        <!-- Fetch all the categories and use a loop to iterate through categories -->
                                        <?php
                                        $sql = "SELECT * FROM `threads` WHERE thread_user_id='$session'";
                                        $result = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['thread_id'];
                                            $cat = $row['thread_title'];
                                            $desc=$row['thread_desc'];
                                            echo '<div class="col-md-3 my-2">
                                                    <div class="card" style="width: 15rem; height:auto;">
                                                          <div class="card-body">
                                                            <h5 class="card-title"><strong>Symptom:</strong><br>' . $cat . '</h5>
                                                            <h6 class="card-title"><strong>Detailed Concern:</strong><br> ' . $desc . '</h6>
                                                            <p class="text-muted">Time: '.$row['timestamp'].'
                                                            <a href="questionlist.php?threadid=' . $id . '" class="btn btn-primary mt-4">View Response</a>
                                                          </div>
                                                    </div>
                                                  </div>';
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </main>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="dashboard.js"></script>
</body>

</html>