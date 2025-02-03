<?php
include '../include/db.php';

    
global $link;
if (isset($_REQUEST['customer'])) {
    $customer = $_POST['customer']; 
    $query = "SELECT sp.*, m.m_name 
    FROM `sale_product` sp
    JOIN `members` m ON sp.member_id = m.m_id";
       
    
    if (!empty($customer)) {
        $query .= " WHERE sp.member_id = ?";
    }

   $stmt = mysqli_prepare($link, $query);
   
   // Bind the supplier ID parameter if filtering
   if (!empty($customer)) {
       mysqli_stmt_bind_param($stmt, "s", $customer);
   }

   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);

   $i = 1;
   $rowcount = mysqli_num_rows($result);

    $total_profit_sum = 0; 
    $total_due_sum = 0;
    $total_trandue_sum = 0;
    if ($rowcount > 0) {
            $records = [];
            
            while ($row = mysqli_fetch_array($result)) {
                $accountid = $row['sale_id'];
        
                $ResultAll = mysqli_query($link, "SELECT * FROM `sale_payments` WHERE purchase_id='$accountid' ORDER BY id DESC LIMIT 1");
                $rowcountall = mysqli_num_rows($ResultAll);
                $totalamount = 0;
                $balance_amount = 0;

                if ($rowcountall > 0) {
                    $paymentRow = mysqli_fetch_array($ResultAll);
                    $totalamount = $paymentRow['Now_Dew'];
                    $balance_amount = $paymentRow['balance_amount'];
                }
        
                $records[] = [
                    'type' => 'sale',
                    'id' => $accountid,
                    'date' => $row['RectimeStamp'],
                    'm_name' => $row['m_name'],
                    'total' => $row['total'],
                    'due' => $row['total'] - $totalamount,
                    'total_due_sum' => $balance_amount,
                ];
            }
        
            // Fetch all transactions for this customer
            $transactionQuery = "SELECT * FROM `transactions` WHERE customer_id = ? AND transaction_type = 'paybalanceamount'";
            $transactionStmt = mysqli_prepare($link, $transactionQuery);
            mysqli_stmt_bind_param($transactionStmt, "s", $customer);
            mysqli_stmt_execute($transactionStmt);
            $transactionResult = mysqli_stmt_get_result($transactionStmt);
        
            while ($transaction = mysqli_fetch_array($transactionResult)) {
                $total_trandue_sum = $transaction['balance_amount'];
             
        
                // Store transaction records
                $records[] = [
                    'type' => 'transaction',
                    'id' => $transaction['transaction_id'],
                    'date' => $transaction['date'],
                    'amount' => $transaction['total_amount'],
                    'total_due_sum' => $total_trandue_sum ,
                    'remark' => $transaction['remark'],
                ];
            }
        
            // Sort records by date
            usort($records, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
        
            // Display records
            $i = 1;
            foreach ($records as $record) {
                if ($record['type'] == 'sale') {
                    ?>
                    <tr style="color: green;">
                        <td><?php echo $i++; ?></td>
                        <td>S<?php echo $record['id']; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($record['date'])); ?></td>
                        <td><?php echo $record['m_name']; ?></td>
                        <td><?php echo $record['total']; ?></td>
                        <td><?php echo $record['due']; ?></td>
                        <td><?php echo $record['total_due_sum']; ?></td>
                        <td>
                            <a href="saleReciept.php?accountid=<?php echo $record['id']; ?>" title="View Receipt" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="viewsalepaymentlist.php?accountid=<?php echo $record['id']; ?>" title="View Payment" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                } else { // Transaction records
                    ?>
                    <tr style="color: blue;">
                        <td><?php echo $i++; ?></td>
                        <td>T<?php echo $record['id'] . ' - ' . $record['remark']; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($record['date'])); ?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $record['amount']; ?></td>
                        <td><?php echo $record['total_due_sum']; ?></td>
                        <td>
                            <a href="transactionDetails.php?transaction_id=<?php echo $record['id']; ?>" title="View Transaction" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
        
        $ResultMember = mysqli_query($link, "SELECT total_due_amount FROM `members` WHERE m_id='$customer'"); 
        $rowcountmember = mysqli_num_rows($ResultMember);
        $totalDue = 0;
        if ($rowcountmember>0) {
            $Rowmember = mysqli_fetch_array($ResultMember);
             $totalDue += $Rowmember['total_due_amount'];
        }
        ?>
        <tr style="font-weight: bold;">
        <td colspan="5" class="text-right">Total Due Amount:</td>
        <td colspan="1"><?php echo $totalDue; ?></td>
        <td colspan="2">
            <?php if ($totalDue > 0) { ?>
                <a href="addsalepayments.php?customer=<?php echo $customer; ?>&total_due=<?php echo $totalDue; ?>" title="Add Payment" 
                class="btn btn-primary btn-sm">
                <i class="fas fa-plus" aria-hidden="true"></i> Add Payment
               </a>
            <?php } else { ?>
                <a title="Paid" class="btn btn-primary btn-sm">
                    <i class="fas fa-circle" aria-hidden="true"></i> Paid
                </a>
            <?php } ?>
        </td>
    </tr>
    <?php

    } else {
        echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
    }
}
?>