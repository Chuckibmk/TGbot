This PHP script defines a class called `user`, which extends the `database` class. The `user` class contains various methods for interacting with a database.

Here's a breakdown of some key methods and their functionalities:

1. `userExists($usid)`: Checks if a user with a given user ID exists in the database.

2. `registerUser($a)`: Registers a new user in the database by inserting their user ID, first name, last name, and username.

3. `refExists($refID)`: Checks if a referral ID exists in the database.

4. `createRef($usID, $rID)`: Creates a referral entry in the database with the given user ID and referral ID.

5. `markpaid($code)`: Updates the state of a deposit to "paid" in the database.

6. `createdeposit($amt, $coin, $orderID, $uid, $doll)`: Creates a new deposit entry in the database with the provided details.

7. `depositExists($txn, $amt, $coin)`: Checks if a deposit with the given transaction ID, amount, and coin exists in the database.

8. `createadmin($adminame, $pwd)`: Creates a new admin user in the database with the provided username and password.

9. `loginUser($un, $pwd)`: Attempts to log in an admin user with the given username and password.

10. `deladmin($id)`: Deletes an admin user from the database based on their ID.

11. `allUserData($id)`: Retrieves all data for a user with the given ID from the database.

12. `getDepositRequest($id)`: Retrieves all pending deposit requests for a user with the given ID from the database.

13. `getdepositpaid($id)`: Retrieves all paid deposits for a user with the given ID from the database.

14. `getDepositConfirmed($id)`: Retrieves all approved deposits for a user with the given ID from the database.

15. `getWithdrawals($id)`: Retrieves all withdrawal requests for a user with the given ID from the database.

16. `getWithdrawalsConfirmed($id)`: Retrieves all approved withdrawals for a user with the given ID from the database.

17. `getReferrals($id)`: Retrieves all referrals for a user with the given ID from the database.

18. `getReferrees($id)`: Retrieves all referrees for a user with the given ID from the database.

19. `referralNo($id)`: Retrieves the count of referrals for a user with the given ID from the database.

20. `referralNoPaid($id)`: Retrieves the count of paid referrals for a user with the given ID from the database.

21. `refBalance($id)`: Retrieves the total bonus amount earned from referrals for a user with the given ID from the database.

22. `deleteUser($id)`: Deletes a user from the database based on their ID.

23. `allUsers()`: Retrieves all users from the database.

24. `allAdmins()`: Retrieves all admin users from the database.

25. `pendingDeposit()`: Retrieves all pending deposit requests from the database.

26. `paidpendingDeposit()`: Retrieves all paid deposit requests from the database.

27. `approvedDeposit()`: Retrieves all approved deposit requests from the database.

28. `pendingWithdrawal()`: Retrieves all pending withdrawal requests from the database.

29. `approvedWithdrawal()`: Retrieves all approved withdrawal requests from the database.

30. `wallet()`: Retrieves all wallet data from the database.


.