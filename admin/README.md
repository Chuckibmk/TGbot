This Folder is the admin panel for the Telegram Bot

in Adminload.php:
The provided code appears to be a PHP script that is used for handling user data and actions in an admin panel. Here's a breakdown of the code:

1. The script includes the "botcontrol.php" file, which likely contains the necessary class definitions and functions.

2. It checks if a session is already started and if the user is logged in. If not, it redirects to the admin login page.

3. It retrieves the original user data from the session variable `$_SESSION['logged']`.

4. If a loaded user is set in the session (`$_SESSION['loaded_user']`), it retrieves the user data for the loaded user and performs various actions related to deposits, referrals, and withdrawals.

5. The loaded user's deposit requests, paid deposits, and confirmed deposits are retrieved using the `getDepositRequest()`, `getdepositpaid()`, and `getDepositConfirmed()` methods of the `$user` object.

6. There are commented out sections related to withdrawals and referral bonuses, which suggest that those features might be implemented but currently not in use.

7. If the "approveDeposit" form is submitted, it approves a deposit request using the `approveDeposit()` method of the `$user` object. It also calculates and grants referral bonuses based on the approved deposit amount.

8. If the "jid" form value is set, it updates a user's deposit information using the `updateUserDeposit()` method of the `$user` object.

9. If the "deleteDeposit" form is submitted, it deletes a deposit entry using the `deleteDeposit()` method of the `$user` object.

10. If the "unloadUser" form is submitted, it unsets the loaded user from the session and redirects to the index page.

Overall, the code seems to handle the display and management of user data, deposit requests, and referrals in an admin panel. It also includes functionality for approving, updating, and deleting deposit entries.

in Adminfetch.php:
The additional code provided seems to continue the script for handling user data and actions in the admin panel. Here's an overview of the added functionality:

1. If the "load" form is submitted, it sets the "loaded_user" session variable to the selected user's ID and redirects to the index page.

2. If the "deleteUser" form is submitted, it deletes a user based on the selected user's ID using the `deleteUser()` method of the `$user` object and redirects to the index page.

3. Several variables are assigned values by calling different methods of the `$user` object, such as `allUsers()`, `allAdmins()`, `pendingDeposit()`, `paidpendingDeposit()`, and `approvedDeposit()`. These variables likely contain data related to users, admins, and deposit requests.

4. If the "adminame" form value is set, it creates a new admin with the provided admin name and password using the `createadmin()` method of the `$user` object. After creating the admin, it redirects to the index page.

5. If the "removeAdmin" form is submitted, it deletes an admin based on the selected admin's ID using the `deladmin()` method of the `$user` object and redirects to the index page.

6. If the "walme" form value is set, it adds a new wallet with the provided wallet name and address using the `addWallet()` method of the `$user` object. After adding the wallet, it redirects to the index page.

7. If the "wid" form value is set, it deletes a wallet based on the selected wallet's ID using the `delWal()` method of the `$user` object and redirects to the index page.

8. If the "wame" form value is set, it updates a wallet's name and address using the `upWall()` method of the `$user` object. After updating the wallet, it redirects to the index page.

9. The code also includes functionality for handling product-related data, such as adding products, deleting products, and editing product details.

   - If the "proname" form value is set, it adds a new product with the provided name, description, image, and URL. The image file is uploaded to the "uploads" directory. After adding the product, it redirects to the index page.

   - If the "dpid" form value is set, it deletes a product based on the selected product's ID using the `delProd()` method of the `$user` object and redirects to the index page.

   - If the "editname" form value is set, it updates a product's name, description, image, and URL. If no new image is selected, the existing image is retained. If a new image is selected, it is uploaded to the "uploads" directory. After updating the product, it redirects to the index page.

Overall, the added code extends the functionality of the admin panel by allowing the selection and deletion of users and admins, managing wallets, and managing products. It also includes file upload functionality for adding and updating product images.
