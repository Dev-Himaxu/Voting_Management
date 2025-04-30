<?php
session_start();

if (!isset($_SESSION['userdata'])) {
    header('Location: login.php');
    exit();
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

$status = ($_SESSION['userdata']['status'] == 0)
    ? '<span style="color: #e74c3c; font-weight: bold;">Not Voted</span>'
    : '<span style="color: #2ecc71; font-weight: bold;">Voted</span>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>

<body>
    <div id="headerSection">
        <div class="buttons">
            <a href=""><button id="backbtn">Back</button></a>
            <a href="logout.php"><button id="logoutbtn">Logout</button></a>
        </div>
        <h1>Online Voting System</h1>
    </div>
    <div id="mainSection">
        <div id="Profile">
            <img src="uploads/<?php echo $userdata['photo']; ?>"><br>
            <b>Name:</b><?php echo $userdata['name']; ?><br>
            <b>Mobile:</b><?php echo $userdata['mobile']; ?><br>
            <b>Address:</b><?php echo $userdata['address']; ?><br>
            <b>Status:</b><?php echo $status; ?><br>
        </div>
        <div id="Group">
            <?php
            if ($_SESSION['groupsdata']) {
                for ($i = 0; $i < count($groupsdata); $i++) {
                    ?>
                    <div class="GroupCard">
                        <img src="uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100px" width="100px"><br>
                        <div class="GroupDetails">
                            <b>Group Name: </b><?php echo $groupsdata[$i]['name']; ?><br>
                            <b>Votes: </b><?php echo $groupsdata[$i]['votes']; ?><br>
                        </div>
                        <form action="vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">
                            <?php
                            if ($_SESSION['userdata']['status'] == 0) {
                                ?>
                                <button id="votebtn" type="submit">Vote</button>
                                <?php
                            } else {
                                ?>
                                <button id="votebtn" type="button" disabled style="background: gray;">Voted</button>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<h2>No Groups Available</h2>";
            }
            ?>
        </div>
    </div>
</body>

</html>