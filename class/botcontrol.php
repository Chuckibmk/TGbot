<?php

include __DIR__ . "/../database/database1.php";

class user extends database{
    //////bot user
    public function userExists($usid){
        $sql = "SELECT id
				FROM users 
				WHERE userid = ?
		";
        return $this->getRow($sql, [$usid]);
    }
    
    public function registerUser($a)
    {
        $sql = "INSERT INTO users (userid,fname,lname,username) 
                VALUES (?,?,?,?);
		";
        try {
            $this->insertRow($sql, [$a['userid'],$a['fname'], $a['lname'],$a['uname']]);
            return $this->lastID();
        } catch (Exception $e) {
            return false;
        }
        
    }
    
    public function refExists($refID){
        $sql = "SELECT id
				FROM users 
				WHERE userid = ?
		";
        return $this->getRow($sql, [$refID])['id'];
    }
    
    public function createRef($usID,$rID)
    {
        $sql = "INSERT INTO referral (uid,rid,time,bonus) 
                VALUES (?,?,?,?);
		";
        try {
            return $this->insertRow($sql, [$usID,$rID,time(),0]);
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function markpaid($code)
    {
        $sql = "UPDATE deposit 
                SET state = ?,last_updated = ?  WHERE time = ?
		";
        return $this->updateRow($sql, ['paid',time(),$code]);
    }
    
    public function createdeposit($amt,$coin,$orderID,$uid,$doll){
        $sql = "INSERT INTO deposit(uid,amount,doll,coin,time,state,last_updated)
                VALUES (?,?,?,?,?,?,?)
		";
        try {
            return $this->insertRow($sql, [$uid,$amt,$doll,$coin,$orderID,'pending',time()]);
        } catch (Exception $e) {
            die("error occurred");
        }
    }
    public function depositExists($txn,$amt,$coin){
        $sql = "SELECT id
				FROM deposit 
				WHERE uid = ? AND amount = ? AND coin = ?
		";
        return $this->getRow($sql, [$txn,$amt,$coin]);
    }
    
    /// admin 
    public function createadmin($adminame,$pwd)
    {
        $sql = "INSERT INTO admin (username,password,pwd) 
                VALUES (?,?,?)
		";
        return $this->insertRow($sql, [$adminame,md5($pwd),$pwd]);
    }
    
    public function loginUser($un, $pwd)
	{
		$sql = "SELECT *
				FROM admin 
				WHERE username = ?
				AND password = ?;
		";
		return $this->getRow($sql, [$un, $pwd]);
	}
	
	public function deladmin($id)
    {
        $sql = "DELETE FROM admin 
				WHERE id = ?
		";
        return $this->deleteRow($sql, [$id]);
    }
    
    public function allUserData($id)
    {
        $sql = "SELECT *
				FROM users 
				WHERE id = ?
		";
        return $this->getRow($sql, [$id]);
    }
    
    public function getDepositRequest($id)
    {
        $sql = "SELECT * FROM deposit WHERE uid = ? AND state = 'pending'
		";
        try {
            return $this->getRows($sql, [$id]);
        } catch (Exception $e) {
            die("error occurred");
        }
    }
    public function getdepositpaid($id)
    {
        $sql = "SELECT * FROM deposit WHERE uid = ? AND state = 'paid'
		";
        try {
            return $this->getRows($sql, [$id]);
        } catch (Exception $e) {
            die("error occurred");
        }
    }
    
    public function getDepositConfirmed($id)
    {
        $sql = "SELECT * FROM deposit WHERE uid = ? AND state = 'approved'
		";
        try {
            return $this->getRows($sql, [$id]);
        } catch (Exception $e) {
            die("error occurred");
        }
    }
    
    public function getWithdrawals($id)
    {
        $sql = "SELECT * FROM withdrawal 
              WHERE uid = ? 
		";
            return $this->getRows($sql, [$id]);
    }
    
    public function getWithdrawalsConfirmed($id)
    {
        $sql = "SELECT * FROM withdrawal
                WHERE uid = ? 
              AND accepted = 'true' 
		";
        return $this->getRows($sql, [$id]);
    }
    
    public function getReferrals($id)
    {
        $sql = "SELECT r.*, u.fname, u.lname, u.userid
                FROM referral r  JOIN users u 
                ON r.uid = u.userid WHERE r.rid = ? 
		";
        try {
            return $this->getRows($sql, [$id]);
        } catch (Exception $e) {
            die("error occurred");
        }
    }
    
    public function getReferrees($id)
    {
        $sql = "SELECT r.*, u.fname, u.lname, u.userid
                FROM referral r  JOIN users u 
                ON r.rid = u.userid WHERE r.uid = ? 
		";
        try {
            return $this->getRows($sql, [$id]);
        } catch (Exception $e) {
            die("error occurred");
        }
    }
    
    public function referralNo($id)
    {
        $sql = "SELECT COUNT(*)
				FROM referral 
				WHERE rid = ? AND uid != 0
				";
        try {
            return $this->getNoRows($sql, [$id]);
        } catch (Exception $e) {
        }
    }

    public function referralNoPaid($id)
    {
        $sql = "SELECT COUNT(*)
				FROM referral 
				WHERE rid = ? AND bonus > 0 AND uid != 0
				";
        try {
            return $this->getNoRows($sql, [$id]);
        } catch (Exception $e) {
        }
    }

    public function refBalance($id)
    {
        $sql = "SELECT SUM(bonus) as total
				FROM referral 
				WHERE rid = ?
				";
            return $this->getRow($sql, [$id]);
    }
    
    public function deleteUser($id){
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->deleteRow($sql, [$id]);
    }
    
    public function allUsers()
    {
        $sql = "SELECT * FROM users";
        return $this->getRows($sql);
    }
    
    public function allAdmins()
    {
        $sql = "SELECT * FROM admin";
        return $this->getRows($sql);
    }
    
    public function pendingDeposit()
    {
        $sql = "SELECT d.*, u.* FROM deposit d JOIN users u ON d.uid = u.userid
				WHERE d.state = ?
		";
        return $this->getRows($sql, ['pending']);
    }
    
    public function paidpendingDeposit()
    {
        $sql = "SELECT d.*, u.* FROM deposit d JOIN users u ON d.uid = u.userid
				WHERE d.state = ?
		";
        return $this->getRows($sql, ['paid']);
    }
    
    public function approvedDeposit()
    {
        $sql = "SELECT d.*, u.* FROM deposit d JOIN users u ON d.uid = u.userid 
				WHERE d.state = ?
		";
        return $this->getRows($sql, ['approved']);
    }
    
    public function pendingWithdrawal()
    {
        $sql = "SELECT w.*, u.* FROM withdrawal w JOIN users u ON w.uid = u.id
				WHERE w.accepted = ?
		";
        return $this->getRows($sql, ['false']);
    }
    
    public function approvedWithdrawal()
    {
        $sql = "SELECT w.*, u.* FROM withdrawals w JOIN users u ON w.uid = u.id
				WHERE w.accepted = ?
		";
        return $this->getRows($sql, ['true']);
    }
    
    public function wallet()
    {
        $sql = "SELECT *
				FROM wallet 
		";
        return $this->getRows($sql);
    }
    public function wallets($nam)
    {
        $sql = "SELECT address
				FROM wallet WHERE name = ?
		";
        return $this->getRows($sql,[$nam]);
    }
    public function upWall($id,$nam,$addr)
    {
        $sql = "UPDATE wallet SET
				name = ?,address = ?,last_updated = ?
				WHERE id = ?
		";
        return $this->updateRow($sql, [$nam,$addr,time(),$id]);
    }
    
    public function delWal($id)
    {
        $sql = "DELETE FROM wallet 
				WHERE id = ?
		";
        return $this->deleteRow($sql, [$id]);
    }
    public function addWallet($name,$add)
    {
        $sql = "INSERT INTO wallet (name,address,last_updated) 
                VALUES (?,?,?)
		";
        return $this->insertRow($sql, [$name,$add,time()]);
    }
    
    /////////////deposit/ withdraw
    public function approveDeposit($id,$amount,$dol)
    {
        $sql = "UPDATE deposit SET
				state = ?, amount = ?,last_updated = ?, doll = ?
				WHERE id = ?
		";
        return $this->updateRow($sql, ['approved',$amount, time(), $dol,$id]);
    }

    public function deleteDeposit($id)
    {
        $sql = "DELETE FROM deposit 
				WHERE id = ?
		";
        return $this->deleteRow($sql, [$id]);
    }
    
    public function wipeDeposit($id)
    {
        $sql = "DELETE FROM deposit 
				WHERE uid = ?
		";
        return $this->deleteRow($sql, [$id]);
    }
    
    public function wipeWithdraw($id)
    {
        $sql = "DELETE FROM withdrawals 
				WHERE uid = ?
		";
        return $this->deleteRow($sql, [$id]);
    }
    
    public function referralBonus($id, $amount){
        $sql = "UPDATE referral SET bonus = ? WHERE uid = ?";
        return $this->updateRow($sql, [$amount, $id]);
    }
    
    public function updateUserDeposit($id,$amount,$doll)
    {
        $sql = "UPDATE deposit SET
				amount = ?, doll = ?
				WHERE id = ?
		";
        return $this->updateRow($sql, [$amount,$doll ,$id]);
    }
    
    public function totalcoin($id, $coin)
    {
        $sql = "SELECT SUM(amount) as total
				FROM deposit 
				WHERE uid = ? AND state = ? AND coin = ?
		";
        return $this->getRow($sql, [$id,'approved',$coin]);
    }
    
    public function allproducts()
    {
        $sql = "SELECT *
				FROM products";
        return $this->getRows($sql);
    }
    
    public function upProd($id,$nam,$text,$image,$url)
    {
        $sql = "UPDATE products SET
				name = ?,text = ?,image = ?,url = ?
				WHERE id = ?
		";
        return $this->updateRow($sql, [$nam,$text,$image,$url,$id]);
    }
    
    public function delProd($id)
    {
        $sql = "DELETE FROM products 
				WHERE id = ?
		";
        return $this->deleteRow($sql, [$id]);
    }
    
    public function addProd($proname,$protext,$promage,$prourl)
    {
        $sql = "INSERT INTO products (name,text,image,url) 
                VALUES (?,?,?,?)
		";
        return $this->insertRow($sql, [$proname,$protext,$promage,$prourl]);
    }
    
}

$user = new User();
