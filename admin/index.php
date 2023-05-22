<?php
ob_start();
require_once 'adminload.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin || TG Bot</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="content-body">
			<div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><a href="../access/">Logout</a></h4>
                            <p class="mb-0">Admin</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <!--<ol class="breadcrumb">-->
                        <!--    <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>-->
                        <!--    <li class="breadcrumb-item active"><a href="javascript:void(0)">Summernote</a></li>-->
                        <!--</ol>-->
                    </div>
                </div>
                <?php
                    if (isset($_SESSION['loaded_user'])) {
                        ?>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <div class="d-md-flex align-items-center">
                                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                                <h4 class="m-b-5"><?= $userData['fname'] . " ". $userData['lname'];?></h4>
                                                <p class=" text-dark">UID: <?= $userData['userid'];?></p>
                                                <p class="text-dark">username: <?= $userData['username'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <form action="" method="post">
                                    <button type="submit" class="btn btn-primary" name="unloadUser">Load
                                        another user
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Funding History</h3>
                                <button class="createAmount">Create Deposit</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable1" class="table table-hover e-commerce-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dollar Value</th>
                                            <th>Amount</th>
                                            <th>Coin</th>
                                            <th>Action</th>
                                            <th>Duration</th>
                                            <th>State</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sn = 1;
                                        foreach (array_merge($userData['deposits'],$userData['getdepositpaid']) as $d) {
                                            ?>
    
                                            <tr>
                                                <td scope="row"><?php echo $sn++; ?></td>
                                                <td scope="row">$<?php echo $d['doll']; ?></td>
    
                                                <td><?php echo $d['amount'] ?></td>
                                                <td><?php echo $d['coin'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($d['accepted'] === "true") {
                                                        echo '<div class="progress progress-md mt-1 h-2">
                                                                <div class="progress-bar progress-bar-animated bg-success w-100">accepted</div>
                                                                   </div>';
                                                    } else {
                                                        ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id"
                                                                   value="<?php echo $d['id'] ?>">
                                                            <input type="hidden" name="dol"
                                                                   value="<?php echo $d['doll'] ?>">
                                                            <input type="hidden" name="amt"
                                                                   value="<?php echo $d['amount'] ?>">
                                                            <label for="amount">Enter dollar received</label><br>
                                                            <input class="form-control" type="number" id="doll"
                                                                   name="dolval"
                                                                   placeholder="<?= $d['doll'];?>"><br>
                                                                <label for="amount">coin amount received</label><br>
                                                            <input class="form-control" type="number" id="amount"
                                                                   name="amount"
                                                                   placeholder="<?= $d['amount'];?>"><br>
                                                            <button type="submit" class="btn btn-success"
                                                                    value="Approve" name="approveDeposit">
                                                                Approve
                                                            </button>
                                                        </form>
                                                        <?php
                                                    }
                                                    ?>
    
                                                </td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $d['id'] ?>">
                                                        <button type="submit" class="btn btn-danger"
                                                                value="Delete" name="deleteDeposit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($d['state'] == 'paid'){
                                                            echo 'Marked Paid';
                                                        }elseif($d['state'] == 'pending'){
                                                            echo 'Pending Payment';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo date('Y-M-d h:i a', $d['time']);
                                                    ?>
                                                </td>
                                            </tr>
    
                                            <?php
                                        }
                                        foreach ($userData['depositsConfirmed'] as $d) {
                                            ?>
    
                                            <tr>
                                                <td scope="row"><?php echo $sn++; ?></td>
                                                <td scope="row">$<?php echo $d['doll']; ?></td>
                                                <td><?= $d['amount'];?>
                                                    <button class="editAmount"
                                                            data-coin="<?= $d['coin']?>"
                                                            data-dolval="<?= $d['doll']?>"
                                                            data-amount="<?= $d['amount']?>"
                                                            id="<?= $d['id'] ?>"
                                                    >Edit</button>
                                                </td>
                                                <td><?php echo $d['coin'] ?></td>
                                                <td>
                                                    <?php
                                                    echo date('D, d-M, Y h:i a', $d['time']);
                                                    ?>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                    
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Wipe Account</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <form action="" method="post">
                                        <label>Wipe  Deposit</label>
                                        <button type="submit" class="btn btn-danger"
                                                value="Delete" name="wipeDeposit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form action="" method="post">
                                        <label>Wipe withdraw</label>
                                        <button type="submit" class="btn btn-danger"
                                                value="Delete" name="wipeWithdraw">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Referral</h3>
                            </div>
                            <div class="card-body">
                                <h4>Referral Link : &nbsp;</h4>
                                <p class="text-dark" style="margin-bottom: 0.66em;">                                    
                                    <?= "https://t.me/tst35bot?start=" . $userData['userid'];?>
                                </p>
                            </div>
                            <div class="card-body">
                                <h5 class="text-dark">Balance: $<?= $userData['referralBonusBal'];?></h5>
                                <br>
                                <h5 class="text-dark">Active Referrals: <?= $userData['referralPaidNo'];?></h5>
                                <br>
                                <h5 class="text-dark">Total Referral(s): <?= $userData['referralNo'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover e-commerce-table">
                                        <thead>
                                            <h4>Referrals</h4>
                                            <tr>
                                                <th>s/n</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach ($userData['referrals'] as $d){
                                                    ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $d['fname']." ".$d['lname']  ?></td>
                                                    <td><?php echo date('D, d-M, Y', $d['time'])?></td>
                                                    <td>
                                                    <?php
                                                       if($d['bonus'] > 0){
                                                           echo '<div class="badge badge-pill badge-success w-100">invested</div>';
                                                       } else{
                                                           echo '<div class="badge badge-pill badge-danger w-100">pending</div>';
                                                       }
                                                    ?>
                                                    </td>
                                                </tr>
                                                    <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover e-commerce-table">
                                        <thead>
                                            <h4>Referrees</h4>
                                            <tr>
                                                <th>s/n</th>
                                                <th>Name</th>
                                                <th>Telegram ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach ($userData['referrees'] as $d){
                                                    ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $d['fname']." ".$d['lname']  ?></td>
                                                    <td><?php echo $d['userid'] ?></td>
                                                </tr>
                                                    <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <?php
                    } else {
                        require_once 'adminfetch.php';
                        ?>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">        
                        <div class="card">
                            <div class="card-header">
			                    <h4 class="card-title">Users</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable" class="table table-hover e-commerce-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User ID</th>
                                                <th>Telegram ID</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach (array_reverse($users) as $d){
                                                    ?>

                                            <tr>
                                                <td>
                                                   <?= $sn++; ?> 
                                                </td>
                                                <td>
                                                    <?= $d['id'];?>
                                                </td>
                                                <td>
                                                    <?= $d['userid'];?>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="m-b-0"><?= $d['fname'] . " " . $d['lname']; ?></h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $d['id']; ?>">
                                                        <button type="submit" name="load" class="btn btn-tone btn-success">
                                                            load user
                                                        </button>
                                                    </form>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $d['id']; ?>">
                                                        <button type="submit" name="deleteUser"
                                                                class="btn btn-tone btn-danger">Delete User
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">        
                        <div class="card">
                            <div class="card-header">
			                    <h4 class="card-title">Pending Deposits</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable4" class="table table-hover e-commerce-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Dollar value</th>
                                                <th>Coin</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach (array_reverse($pDeposits) as $d){
                                                    ?>
                                            <tr>
                                                <td scope="row"><?= $sn++; ?></td>
                                                <td><?=  $d['fname'].''.$d['lname']; ?></td>
                                                <td><?= $d['amount'];?></td>
                                                <td>$<?= $d['doll'];?></td>
                                                <td><?= $d['coin'];?></td>
                                                <td><?= date('Y-m-d H:i:s', $d['time']);?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $d['id']; ?>">
                                                        <button type="submit" name="load" class="btn btn-tone btn-success">
                                                            load user
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">        
                        <div class="card">
                            <div class="card-header">
			                    <h4 class="card-title">Pending Deposits Marked Paid</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable41" class="table table-hover e-commerce-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Dollar value</th>
                                                <th>Coin</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach (array_reverse($paDeposits) as $d){
                                                    ?>
                                            <tr>
                                                <td scope="row"><?= $sn++; ?></td>
                                                <td><?=  $d['fname'].''.$d['lname']; ?></td>
                                                <td><?= $d['amount'];?></td>
                                                <td>$<?= $d['doll'];?></td>
                                                <td><?= $d['coin'];?></td>
                                                <td><?= date('Y-m-d H:i:s', $d['time']);?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $d['id']; ?>">
                                                        <button type="submit" name="load" class="btn btn-tone btn-success">
                                                            load user
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">        
                        <div class="card">
                            <div class="card-header">
			                    <h4 class="card-title">Approved Deposits</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable6" class="table table-hover e-commerce-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Dollar value</th>
                                                <th>Coin</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach (array_reverse($aDeposits) as $d){
                                                    ?>

                                            <tr>
                                                <td scope="row"><?= $sn++; ?></td>
                                                <td><?=  $d['fname'].''. $d['lname']; ?></td>
                                                <td><?= $d['amount'];?></td>
                                                <td>$<?= $d['doll'];?></td>
                                                <td><?= $d['coin'];?></td>
                                                <td><?= date('Y-m-d H:i:s', $d['time']);?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $d['id']; ?>">
                                                        <button type="submit" name="load" class="btn btn-tone btn-success">
                                                            load user
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">        
                        <div class="card">
                            <div class="card-header">
			                    <h4 class="card-title">Admin</h4>
			                    <button class="newAdmin">Create Admin</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable8" class="table table-hover e-commerce-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Password</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach (array_reverse($admins) as $d){
                                                    ?>

                                            <tr>
                                                <td>
                                                   <?php echo $sn++; ?> 
                                                </td>
                                                <td>
                                                    <?= $d['username'];?>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="m-b-0"><?= $d['pwd']; ?></h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $d['id'] ?>">
                                                        <button type="submit" name="removeAdmin"
                                                                class="btn btn-danger">Delete Admin
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="card">
                            <div class="card-header">
			                    <h4 class="card-title">Products</h4>
			                    <button class="newProduct">Add new product</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable91" class="table table-hover e-commerce-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Text</th>
                                                <th>URL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                foreach ($product as $d){
                                                    ?>

                                            <tr>
                                                <td>
                                                   <?php echo $sn++; ?> 
                                                </td>
                                                <td>
                                                    <?= $d['name'];?>
                                                </td>
                                                <td>
                                                    <?= $d['image'];?>
                                                </td>
                                                <td>
                                                    <?= $d['text'];?>
                                                </td>
                                                <td>
                                                    <?= $d['url'];?>
                                                </td>
                                                <td>
                                                    <button class="editProd btn btn-tone btn-warning"
                                                        data-name="<?php echo $d['name']?>"
                                                        data-text="<?php echo $d['text']?>"
                                                        data-image="<?php echo $d['image']?>"
                                                        data-url="<?php echo $d['url']?>"
                                                        id="<?php echo $d['id'] ?>">
                                                        Edit Product
                                                    </button>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="dpid"
                                                               value="<?php echo $d['id'] ?>">
                                                        <button type="submit" name="delprod"
                                                                class="btn btn-danger">
                                                            Delete 
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      <?php  
                        }
                    ob_end_flush();
                    ?>
            </div>
        </div>
    
    <div id="editmodal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        Coin
                        <input type="text" disabled name="jcoin" class="form-control" id="jcoin"><br>
                        dollar value
                        <input type="text" name="jdol" onfocusout="coinamt()" class="form-control" id="jdol"><br>
                        Amount
                        <input type="text" name="jamount" class="form-control" id="jamount"><br>
                        <input type="hidden" name="jid" class="form-control" id="jid"><br>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="newAdmin" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        Username
                        <input type="text" name="adminame" data-toggle="tooltip" title="Username" placeholder="Username" required class="form-control"><br>
                        Password
                        <input type="text" name="pwd" placeholder="Password" required class="form-control"><br>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>    
    
    <div id="createmodal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        dollar value
                        <input type="text" name="credol" required class="form-control"><br>
                        Amount
                        <input type="text" name="creamt" required class="form-control"><br>
                        current week earnings
                        <input type="text" name="crearnd" required class="form-control"><br>
                        total earned
                        <input type="text" name="totearn" required class="form-control"><br>
                        coin
                       <select name="fund_method" class="form-control" required>
                            <option>BTC</option>
							<option>ETH</option>
							<option>LTC</option>
							<option>BCH</option>
							<option>USDT(ERC20)</option>
							<option>USDT(TRC20)</option>
							<option>USDT(BEP20)</option>
                        </select><br>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="newProduct" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        Name
                        <input type="text" name="proname" data-toggle="tooltip" title="Product Name" placeholder="BITMAIN ANTMINER S9J (14.5TH)" required class="form-control"><br>
                        Text
                        <textarea type="text" name="protext" class="form-control"></textarea><br>
                        Image
                        <input name="fileToUpload" type="file" class="form-control"><br>
                        URL
                        <input type="text" name="prourl" class="form-control"><br>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div id="editProd" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        Name
                        <input type="text" name="editname" id="editname" class="form-control"><br>
                        Product Text
                        <input type="text" name="edittext" id="edittext" class="form-control"><br>
                        Product Link
                        <input type="text" name="editurl" id="editurl" class="form-control"><br>
                        Product Image
                        <input type="file" name="editimg" class="form-control"><br>
                        
                        <input type="hidden" name="hidimg" id="editimg" class="form-control"><br>
                        
                        <input type="hidden" name="editid" id="editid">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable();
        });
        $(document).ready(function () {
            $('#usersTable1').DataTable();
        });
        
        $(document).ready(function () {
            $('#usersTable3').DataTable();
        });
        $(document).ready(function () {
            $('#usersTable4').DataTable();
        });
        $(document).ready(function () {
            $('#usersTable41').DataTable();
        });
        $(document).ready(function () {
            $('#usersTable5').DataTable();
        });
        $(document).ready(function () {
            $('#usersTable6').DataTable();
        });
        
        $(document).ready(function () {
            $('#usersTable7').DataTable();
        });
        $(document).ready(function () {
            $('#usersTable8').DataTable();
        });
        $(document).ready(function () {
            $('#usersTable9').DataTable();
        });
        
        $('.newProduct').click(function () {
            $('#newProduct').modal('hide').modal('show');
        });
        
        $('.editProd').click(function () {
        $('#editProd').modal('hide').modal('show');
        $('#editname').val($(this).attr('data-name'));
        $('#edittext').val($(this).attr('data-text'));
        $('#editurl').val($(this).attr('data-url'));
        $('#editimg').val($(this).attr('data-image'));
        $('#editid').val($(this).attr('id'));
        });
        
        $('.newAdmin').click(function () {
            $('#newAdmin').modal('hide').modal('show');
        });        
    
        $('.editAmount').click(function () {
        $('#editmodal').modal('hide').modal('show');
        $('#jamount').val($(this).attr('data-amount'));
        $('#jearned').val($(this).attr('data-earned'));
        $('#jdol').val($(this).attr('data-dolval'));
        $('#jcoin').val($(this).attr('data-coin'));
        $('#jid').val($(this).attr('id'));
        });
        
        $('.createAmount').click(function () {
            $('#createmodal').modal('hide').modal('show');
        });
        
        function coinamt(){
            var y = $('#jdol').val();
            var w = document.getElementById("jamount");
            var z = $('#jcoin').val();
            
            
            if(z === "BTC"){
                fetch('https://api.binance.com/api/v3/avgPrice?symbol=BTCUSDT')
                .then(r => r.json().then(
                j =>{chuck(j)}));
                }else if(z == "ETH"){
                    fetch('https://api.binance.com/api/v3/avgPrice?symbol=ETHUSDT')
                    .then(r => r.json().then(
                    j =>{chuck(j)}));
                }else if(z == "BCH"){
                    fetch('https://api.binance.com/api/v3/avgPrice?symbol=BCHUSDT')
                    .then(r => r.json().then(
                    j =>{chuck(j)}));
                }else if(z == "LTC"){
                    fetch('https://api.binance.com/api/v3/avgPrice?symbol=LTCUSDT')
                    .then(r => r.json().then(
                    j =>{chuck(j)}));
                }else if(z == "USDT(BEP20)" || "USDT(ERC20)" || "USDT(TRC20)"){
                    w.value = y;
                }
            
            function chuck(d){
                var curval = y/d.price;
                w.value = curval.toFixed(7);
            } 
        }
    </script>
  </body>
</html>