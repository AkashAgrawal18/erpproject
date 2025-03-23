<!DOCTYPE html>
<html>

<head>
    <title>Stock Transfer</title>
</head>

<body>
    <h2>Stock Transfer</h2>
    <?php if ($this->session->flashdata('success')) echo "<p>" . $this->session->flashdata('success') . "</p>"; ?>
    <?php if ($this->session->flashdata('error')) echo "<p>" . $this->session->flashdata('error') . "</p>"; ?>

    <form action="<?= site_url('StockTransfer/transfer') ?>" method="POST">
        <label>Batch ID:</label> <input type="text" name="batch_id" required><br>
        <label>From Warehouse ID:</label> <input type="text" name="from_warehouse" required><br>
        <label>To Warehouse ID:</label> <input type="text" name="to_warehouse"><br>
        <label>To Entity ID (if applicable):</label> <input type="text" name="to_entity"><br>
        <label>Quantity:</label> <input type="text" name="quantity" required><br>
        <button type="submit">Transfer Stock</button>
    </form>
</body>

</html>