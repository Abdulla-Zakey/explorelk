<?php
//session_start(); // Start the session

 
  include '../app/views/components/eonavbar.php';


// Fetch saved bank accounts from the session
$bankAccounts = isset($_SESSION['bank_accounts']) ? $_SESSION['bank_accounts'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Accounts - ExploreLk</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Eventorganizer/eopayments.css">
</head>
<body>

    <div class="bank-accounts-heading">
        <h2>Bank Accounts</h2>
        <hr>   
    </div>

    <div class="container">
        <div class="bank-accounts">
            <?php if (count($bankAccounts) > 0): ?>
                <!-- Display list of bank accounts -->
                <?php foreach ($bankAccounts as $index => $account): ?>
                    <div class="account-details" id="account-<?= $index ?>">
                        <p><strong>Account Holder:</strong> <?= htmlspecialchars($account['accountHolderName']) ?></p>
                        <p><strong>Bank Name:</strong> <?= htmlspecialchars($account['bankName']) ?></p>
                        <p><strong>Account Type:</strong> <?= htmlspecialchars($account['accountType']) ?></p>
                        <p><strong>Account Number:</strong> <?= htmlspecialchars($account['accountNumber']) ?></p>
                        <p><strong>Branch:</strong> <?= htmlspecialchars($account['branch']) ?></p>
                        <p><strong>NIC Number:</strong> <?= htmlspecialchars($account['nicNumber']) ?></p>
                        <!-- Delete button -->
                        <button class="delete-btn" onclick="deleteBankAccount(<?= $index ?>)">Delete</button>
                        <hr>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="content">
                    <div class="icon">
                        🏦
                    </div>
                    <p>No bank account is linked yet.<br>Please add one.</p>
                    <div class="add-bank-button">
                        <a href="javascript:void(0)" class="add-btn" onclick="openPopup()">Add Bank Account</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for the Bank Information Form -->
    <div id="bankModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Add Bank Account</h2>
            <form id="bankForm" onsubmit="submitBankForm(event)">
                <div class="form-row">
                    <div class="form-group">
                        <label for="accountHolderName">Account Holder Name:</label>
                        <input type="text" id="accountHolderName" name="accountHolderName" required>
                    </div>

                    <div class="form-group">
                        <label for="bankName">Bank Name:</label>
                        <input type="text" id="bankName" name="bankName" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="accountType">Account Type:</label>
                        <input type="text" id="accountType" name="accountType" required>
                    </div>

                    <div class="form-group">
                        <label for="accountNumber">Account Number:</label>
                        <input type="text" id="accountNumber" name="accountNumber" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="branch">Branch:</label>
                        <input type="text" id="branch" name="branch" required>
                    </div>

                    <div class="form-group">
                        <label for="nicNumber">NIC Number:</label>
                        <input type="text" id="nicNumber" name="nicNumber" required>
                    </div>
                </div>

                <button type="submit" class="add-btn">Add Bank Account</button>
            </form>
        </div>
    </div>

    <!-- Success message popup -->
    <div id="successMessage" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeSuccessPopup()">&times;</span>
            <h2>Bank account added successfully!</h2>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById("bankModal").style.display = "block";
            document.body.classList.add("blur");
        }

        function closePopup() {
            document.getElementById("bankModal").style.display = "none";
            document.body.classList.remove("blur");
        }

        function submitBankForm(event) {
            event.preventDefault(); // Prevent form submission and page reload

            // Get form data
            const accountHolderName = document.getElementById("accountHolderName").value;
            const bankName = document.getElementById("bankName").value;
            const accountType = document.getElementById("accountType").value;
            const accountNumber = document.getElementById("accountNumber").value;
            const branch = document.getElementById("branch").value;
            const nicNumber = document.getElementById("nicNumber").value;

            // Create an object with the form data
            const formData = {
                accountHolderName: accountHolderName,
                bankName: bankName,
                accountType: accountType,
                accountNumber: accountNumber,
                branch: branch,
                nicNumber: nicNumber
            };

            // Send the data via AJAX to save_bank_account.php
            fetch('save_bank_account.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close the modal
                    closePopup();

                    // Show success message
                    document.getElementById("successMessage").style.display = "block";
                    document.body.classList.add("blur");

                    // Append the new bank account to the list
                    const bankAccountDiv = document.createElement("div");
                    bankAccountDiv.classList.add("account-details");
                    bankAccountDiv.setAttribute("id", `account-${data.index}`);
                    bankAccountDiv.innerHTML = `
                        <p><strong>Account Holder:</strong> ${data.accountHolderName}</p>
                        <p><strong>Bank Name:</strong> ${data.bankName}</p>
                        <p><strong>Account Type:</strong> ${data.accountType}</p>
                        <p><strong>Account Number:</strong> ${data.accountNumber}</p>
                        <p><strong>Branch:</strong> ${data.branch}</p>
                        <p><strong>NIC Number:</strong> ${data.nicNumber}</p>
                        <button class="delete-btn" onclick="deleteBankAccount(${data.index})">Delete</button>
                        <hr>
                    `;
                    document.querySelector('.bank-accounts').appendChild(bankAccountDiv);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function deleteBankAccount(index) {
            // Send the delete request via AJAX
            fetch('save_bank_account.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ index: index })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the bank account from the page
                    document.getElementById(`account-${index}`).remove();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function closeSuccessPopup() {
            document.getElementById("successMessage").style.display = "none";
            document.body.classList.remove("blur");
        }
    </script>

</body>
</html>
