<?php
include __DIR__ . "/../class/botcontrol.php";

if(session_status() === PHP_SESSION_NONE)
{
    session_start();//start session if session not start
}

if(!isset($_SESSION['logged'])){
    header('location: admin login page');
}

$oID = $_SESSION['logged'];
$originalData = $user->allUserData($oID);

if(isset($_SESSION['loaded_user'])){
    $uID = $_SESSION['loaded_user'];

    $userData = $user->allUserData($uID);
    
    $userData['deposits'] = $user->getDepositRequest($userData['userid']);
    $userData['getdepositpaid'] = $user->getdepositpaid($userData['userid']);
    $userData['depositsConfirmed'] = $user->getDepositConfirmed($userData['userid']);
    
    // $userData['withdrawals'] = $user->getWithdrawals($uID);
    // $userData['withdrawalsConfirmed'] = $user->getWithdrawalsConfirmed($uID);
    
    $userData['referrals'] = $user->getReferrals($userData['userid']);
    $userData['referrees'] = $user->getReferrees($userData['userid']);
    
    // $userData['withdrawnRefBonus'] = number_format((float)$user->withdrawnRefBonus($uID)['total'], 2, '.', '');
    $userData['referralNo'] = $user->referralNo($userData['userid']);
    $userData['referralPaidNo'] = $user->referralNoPaid($userData['userid']);
    $userData['refBalance'] = number_format((float)$user->refBalance($userData['userid'])['total'], 2, '.', '');
    $userData['referralBonusBal'] = $userData['refBalance'];
    // number_format((float)($userData['refBalance'] - $userData['withdrawnRefBonus']), 2, '.', '');
    // ////////////////////////////////
    
    if(isset($_POST['approveDeposit'])){
        if(empty($_POST['amount'])){
            $amt = $_POST['amt'];
        }else{
            $amt = $_POST['amount'];
        }
        if(empty($_POST['dolval'])){
            $dol = $_POST['dol'];
        }else{
            $dol = $_POST['dolval'];
        }
        $user->approveDeposit($_POST['id'],$amt,$dol);
        $amt = $_POST['amount'];
        
        $ref_bonus = (5 / 100) * $amt;
        $refe = $user->referralBonus($userData['userid'], $ref_bonus);
        
        header("Location: index.php");
    }
    
    if(isset($_POST['jid'])){
        $user->updateUserDeposit($_POST['jid'],$_POST['jamount'],$_POST['jdol']);
        header("Location: index.php");
    }
    
    if(isset($_POST['deleteDeposit'])){
        $user->deleteDeposit($_POST['id']);
        header("Location: index.php");
    }
    
    /////////////////////////////////
    
    if(isset($_POST['unloadUser'])){
       unset($_SESSION['loaded_user']);
        header("Location: index.php");
    }
}
