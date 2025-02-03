<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        @media print {
            @page {
                size: A5;
                margin: 0;
            }
            body {
                margin: 0;
            }
            .invoice-container {
                padding: 10mm;
                border: none;
            }
            button {
                display: none;
            }
        }

        .invoice-container {
            max-width: 21cm;
            margin: auto;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        h4 {
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
        }

        .bank-details {
            font-size: 10px;
            text-align: left;
        }

        .signature {
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<?php
include_once '../include/ram.php';
    require_once '../include/db.php';
    $ramObj = new ram;
     if (isset($_GET['accountid'])) {
        $accountid=$_GET['accountid'];
    }
?>
<body>

<div class="invoice-container">
    <div class="title">
        <h4>Sale Receipt</h4>
    </div>
    
    <div class="row">
        <div class="col-6">
            <strong>From:</strong><br>
            Raj Building Material<br>
            Khargsenpur, Thanagaddi, Kerakat Jaunpur-222181<br>
            GSTIN-09DATPS7909Q1Z8<br>
            Mobile No. 8787035079, 9936161515
        </div>
        <?php  
                                        if (isset($_GET['accountid'])) {
         $accountid=$_GET['accountid'];
    }


                                       $ResultAll = mysqli_query($link, "SELECT * FROM `sale_product` WHERE sale_id ='$accountid'");
 
    $RowAll = mysqli_fetch_array($ResultAll);
    $memcode=$RowAll['member_id'];

     $ResultAlls = mysqli_query($link, "SELECT * FROM `members` WHERE m_id  ='$memcode'");
 
    $RowAlls = mysqli_fetch_array($ResultAlls);
    ?>
        <div class="col-6 text-end">
            <strong>Bill No:</strong> #S<?php echo $RowAll['sale_id']; ?><br>
            <strong>Date:</strong> <?php echo $RowAll['RectimeStamp']; ?>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-6">
            <strong>To:</strong><br>
            <b><?php echo $RowAlls['m_name']; ?></b><br>
            <?php echo $RowAlls['m_address']; ?><br>
            Mobile: <?php echo $RowAlls['m_mobile']; ?>
        </div>
    </div>

    <hr>

    <table>
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal (Rs.)</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $purchasetempid = $RowAll['saletemp_id'];
            $ResultAllss = mysqli_query($link, "SELECT * FROM sale_product_list WHERE purchase_id='$purchasetempid'");
            $totalamount = 0;
            $i = 1;
            while ($RowAllss = mysqli_fetch_array($ResultAllss)) {
                $p_name = $RowAllss['product_id'];
                $ResultAllsss = mysqli_query($link, "SELECT * FROM product WHERE Product_Code='$p_name'");
                $RowAllsss = mysqli_fetch_array($ResultAllsss);
                $unit = $RowAllsss['unit'];
                $Resultunit = mysqli_query($link, "SELECT * FROM unit WHERE id='$unit'");
                $Rowunit = mysqli_fetch_array($Resultunit);
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $RowAllsss['Name']; ?> (<?php echo $RowAllsss['Product_Code']; ?>)</td>
                <td><?php echo $RowAllss['product_amount']; ?></td>
                <td><?php echo $RowAllss['Quantity']; ?> (<?php echo $Rowunit['unit_name']; ?>)</td>
                <td><?php echo $RowAllss['Total_amount']; $totalamount += $RowAllss['Total_amount']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><strong>Total</strong></td>
                <td><strong><?php echo $totalamount; ?></strong></td>
            </tr>
            <tr>
                <td colspan="4"><strong>CGST</strong></td>
                <td><?php echo $RowAll['cgst']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>SGST</strong></td>
                <td><?php echo $RowAll['igst']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Labour Charges</strong></td>
                <td><?php echo $RowAll['labourcharge']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Fare Charges</strong></td>
                <td><?php echo $RowAll['farecharge']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Discount</strong></td>
                <td><?php echo $RowAll['discount']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Total</strong></td>
                <td><?php echo $RowAll['total']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Total Deposit</strong></td>
                <td><?php echo $RowAll['deposit']; ?></td>
            </tr>
        </tfoot>
    </table>

    <hr>

    <div class="bank-details">
        <strong>Bank Details:</strong><br>
        1. Raj Building Materials (Union Bank, A/C: 417005040005027, IFSC: UBIN0541702, Branch: Thanagaddi Jaunpur)<br>
        2. Google Pay/Phone Pay: 9125750715<br>
        3. WhatsApp: 9125750715
    </div>

    <div class="signature">
        <strong>For Raj Building Material</strong><br><br>
        Signature
    </div>

    <button class="btn btn-primary mt-3" onclick="window.print(); return false;">Print</button>
</div>

</body>
</html>