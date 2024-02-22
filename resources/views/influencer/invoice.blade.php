<?php
/**
 * @var $campaignUserInfo
 * @var $influencerInfo
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Invoice - <?php echo $campaignUserInfo['id'];?></title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img alt="Logo" src="data:image/png;base64,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" style="width: 25%; max-width: 300px" />
                        </td>

                        <td>
                            Invoice #: <?php echo $campaignUserInfo['id'];?><br />
                            Created: <?php echo date('Y-m-d');?><br />
                            Due: <?php echo date('Y-m-d', strtotime('+1 month'));?><br/>
                            Status: UNPAID
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td width="50%">
                            <?php echo ucwords(strtolower($influencerInfo['full_name'])) .'<br />'.$influencerInfo['address'].'<br />'.$influencerInfo['email'];?>
                        </td>

                        <td width="50%">
                            <?php echo ucwords(strtolower($campaignUserInfo['campaignInfo']['organizationInfo']['adminInfo']['full_name'])) .'<br />'.$campaignUserInfo['campaignInfo']['organizationInfo']['name'].'<br/>'.$campaignUserInfo['campaignInfo']['organizationInfo']['adminInfo']['address'].'<br />'.$campaignUserInfo['campaignInfo']['organizationInfo']['adminInfo']['email'];?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>

            <td>Reference #</td>
        </tr>

        <tr class="details">
            <td>Online</td>

            <td>-</td>
        </tr>

        <tr class="heading">
            <td>Item</td>

            <td>Price</td>
        </tr>

        <tr class="item">
            <td>Campaign hosting</td>

            <td>$<?php echo $campaignUserInfo['budget'];?>.00</td>
        </tr>

        <tr class="item last">
            <td>Other charge</td>

            <td>$0.00</td>
        </tr>

        <tr class="total">
            <td></td>

            <td>Total: $<?php echo $campaignUserInfo['budget'];?>.00</td>
        </tr>
    </table>
</div>
</body>
</html>
