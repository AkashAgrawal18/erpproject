<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GST Invoice</title>
  <style>
    body {
      font-size: 12px;
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 5px;
      text-align: center;
    }

    .no-border {
      border: none;
    }

    .header-title {
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      margin: 10px 0;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    .text-bold {
      font-weight: bold;
    }

    .terms {
      font-size: 11px;
    }
  </style>
</head>

<body>
  <table class="no-border">
    <tr>
      <td style="width: 50%;" class="text-left">
        <strong><?= get_settings('m_app_title') ?></strong><br>
        <?= get_settings('m_app_address') ?><br>
        Phone: <?= get_settings('m_app_mobile') ?><br>
      </td>
      <td style="width: 50%;" class="text-left">
        <strong><?= $edit_value->m_entity_name ?></strong><br>
        <?= $edit_value->m_entity_address ?><br>
        Ph.No: <?= $edit_value->m_entity_mobile ?>,GSTIN: <?=  $edit_value->m_entity_gstno ?>
      </td>
    </tr>

  </table>
  <table class="no-border">
    <tr>
      <td> E-Mail: <?= get_settings('m_app_email') ?></td>
      <td rowspan="2">GST INVOICE</td>
      <td>Invoice No- <?= $edit_value->m_inv_no ?></td>
      <td>Date - <?= date('d-m-Y', strtotime($edit_value->m_inv_date)) ?></td>
    </tr>
    <tr>
      <td> GSTIN: <?= get_settings('m_app_gstno')?></td>
      <td>Sale Man- </td>
      <td>Due Date-</td>
    </tr>
  </table>

  <table>
    <thead>
      <th>SR.</th>
      <th>PRODUCT</th>
      <th>BATCH</th>
      <th>QTY</th>
      <th>MRP</th>
      <th>EXP</th>
      <th>HSN</th>
      <th>Value</th>
      <th>SGST</th>
      <th>CGST</th>
      <th>IGST</th>
      <th>RATE</th>
      <th>DIS</th>
      <th>Amount</th>
    </thead>
    <tbody>
      <?php
      $taxper = (int)get_settings('m_app_tax'); 
      $tqty = 0; 
      if (!empty($id)) {
        $cou = 0;
        foreach ($edit_value->item_data as $kry) {
          $cou++;
          $tqty += $kry->inv_item_qty;
      ?>
          <tr>
            <td><?= $cou ?></td>
            <td><?= $kry->m_pro_name ?> <?= $kry->package_name ?> <?= $kry->size_name ?></td>
            <td><?= $kry->m_batch_number ?></td>
            <td><?= $kry->inv_item_qty ?></td>
            <td><?= $kry->inv_item_rate ?></td>
            <td>6/25</td>
            <td>17011310</td>
            <td><?= $kry->inv_item_pretaxamt ?></td>
            <td><?= $kry->inv_item_sgst != 0 ? $taxper/2 :'0';?></td>
            <td><?= $kry->inv_item_cgst != 0 ? $taxper/2 :'0';?></td>
            <td><?= $kry->inv_item_igst != 0 ? $taxper :'0';?></td>
            <td><?= $kry->inv_item_rate ?></td>
            <td><?= $kry->inv_item_disper ?></td>
            <td><?= $kry->inv_item_netamt ?></td>
          </tr>

      <?php
        }
      }
      ?>

    </tbody>
  </table>

  <p class="text-right text-bold">TOTAL CASE : <?= $tqty?>, TOTAL PCS : 0</p>

  <table>
    <tr>
      <th>CLASS</th>
      <th>TOTAL</th>
      <th>SCH.</th>
      <th>DISC.</th>
      <th>SGST</th>
      <th>CGST</th>
      <th>TOTAL GST</th>
       <th><strong>SUB TOTAL:</strong> <?= $edit_value->m_inv_pretax_amount ?></th>
    </tr>
    <tr>
      <td>GST 5.00</td>
      <td><?= $edit_value->m_inv_pretax_amount ?></td>
      <td>0.00</td>
      <td><?= $edit_value->m_inv_discount ?></td>
      <td><?= $edit_value->m_inv_sgst ?></td>
      <td><?= $edit_value->m_inv_cgst ?></td>
      <td><?= $edit_value->m_inv_sgst + $edit_value->m_inv_cgst + $edit_value->m_inv_igst?></td>
      <th><strong>SGST PAYABLE:</strong> <?= $edit_value->m_inv_sgst ?></th>
    </tr>
    <tr>
      <td>GST 12.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <th><strong>CGST PAYABLE:</strong><?= $edit_value->m_inv_cgst ?> </th>
    </tr>
    <tr>
      <td>GST 18.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <th><strong>IGST PAYABLE:</strong> <?= $edit_value->m_inv_igst ?></th>
    </tr>

    <tr>
      <td>GST 24.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <td>0.00</td>
      <th><strong>CR/DR NOTE:</strong> <?= $edit_value->m_inv_discount ?> </th>
    </tr>
    <tr>
      <td>Total</td>
      <td><?= $edit_value->m_inv_pretax_amount ?></td>
      <td>0.00</td>
      <td><?= $edit_value->m_inv_discount ?></td>
      <td><?= $edit_value->m_inv_sgst?></td>
      <td><?= $edit_value->m_inv_cgst?></td>
      <td><?= $edit_value->m_inv_sgst + $edit_value->m_inv_cgst + $edit_value->m_inv_igst?></td>
      <td><strong>GRAND TOTAL:</strong> <?= $edit_value->m_inv_totalamt ?></td>
    </tr>
  </table>

  <p><strong>Rs. <?= convert_number_to_words($edit_value->m_inv_totalamt)?></strong></p>

  <table class="no-border">
    <tr>
      <td class="terms text-left">
        <strong>Terms & Conditions</strong><br>
        Goods once sold will not be taken back or exchanged.<br>
        Bills not paid due date will attract 24% interest.
      </td>
      <td class="text-right">
        <strong>Receiver</strong><br>
      </td>
      <td class="text-right">
        For SANGEETA CONSUMER GOODS PRIVATE LIMITED
      </td>
    </tr>
  </table>
  <script>
    window.onload = function () {
        window.print();
    };

    window.onafterprint = function () {
        window.history.back();
    };
</script>
</body>

</html>