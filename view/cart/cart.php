<head>
    <script>
        function updateCartItem(obj, id) {
            $.get("index.php?c=cart&a=updateCartItem", {
                id: id,
                qty: obj.value
            }, function(data) {
                if (data == 'ok') {
                    console.log(data);
                    location.reload();
                } else {
                    alert('Cart update failed, please try again.');
                }
            });
        }
    </script>
</head>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">

            <ul class="nav nav-pills">
                <li role="presentation"><a href="index.php">Inicio</a></li>
                <li role="presentation" class="active"><a href="index.php?c=cart">Ver Carta</a></li>
                <li role="presentation"><a href="index.php?c=payment">Pagos</a></li>
            </ul>
        </div>

        <div class="panel-body">
            <h1>Carrito de compras</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sub total</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($this->cart->total_items() > 0) {
                        //get cart items from session
                        $cartItems = $this->cart->contents();
                        foreach ($cartItems as $item) {
                    ?>
                            <tr>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo '$' . $item["price"] . ' USD'; ?></td>
                                <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                                <td><?php echo '$' . $item["subtotal"] . ' USD'; ?></td>
                                <td>
                                    <a href="index.php?c=cart&a=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Confirma eliminar?')"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5">
                                <p>Tu carta esta vacia.....</p>
                            </td>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Comprando</a></td>
                        <td colspan="2"></td>
                        <?php if ($this->cart->total_items() > 0) { ?>
                            <td class="text-center"><strong>Total <?php echo '$' . $this->cart->total() . ' USD'; ?></strong></td>
                            <td><a href="index.php?c=payment" class="btn btn-success btn-block">Pagos <i class="glyphicon glyphicon-menu-right"></i></a></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="panel-footer">AulaMatriz</div>
    </div><!--Panek cierra-->

</div>
</body>

</html>