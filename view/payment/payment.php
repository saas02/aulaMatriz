<head>
    <style>
        .table {
            width: 65%;
            float: left;
        }

        .shipAddr {
            width: 30%;
            float: left;
            margin-left: 30px;
        }

        .footBtn {
            width: 95%;
            float: left;
        }

        .orderBtn {
            float: right;
        }
    </style>
</head>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">

            <ul class="nav nav-pills">
                <li role="presentation"><a href="index.php">Inicio</a></li>
                <li role="presentation"><a href="index.php?c=cart">Ver Carta</a></li>
                <li role="presentation" class="active"><a href="index.php?c=payment">Pagos</a></li>
            </ul>
        </div>

        <div class="panel-body">
            <h1>Vista previa de la Orden</h1>
            <?php
            if (!empty($this->sessionData["errors"])) {
                /** Examinacion de strings */
                $count = substr_count(($this->sessionData["errors"]), 'error');
                echo "<div class='alert alert-danger'>"
                    /** Formato de strings */
                    . sprintf(
                        "Se presento %d error:  %s",
                        $count,
                        strtoupper(trim($this->sessionData["errors"]))
                    ) .
                    /** trim extraccion strings quita espacios*/
                    /** Modificador de caracteres */
                    "</div>";
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Pricio</th>
                        <th>Cantidad</th>
                        <th>Sub total</th>
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
                                <td><?php echo $item["qty"]; ?></td>
                                <td><?php echo '$' . $item["subtotal"] . ' USD'; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="4">
                                <p>No hay articulos en tu carta......</p>
                            </td>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <?php if ($this->cart->total_items() > 0) { ?>
                            <td class="text-center"><strong>Total <?php echo '$' . $this->cart->total() . ' USD'; ?></strong></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
            <div class="shipAddr">
                <h4>Detalles de envío</h4>
                <p><?php echo $this->clients['name']; ?></p>
                <p><?php echo $this->clients['email']; ?></p>
                <p><?php echo $this->clients['phone']; ?></p>
                <p><?php echo $this->clients['address']; ?></p>
            </div>
            <div class="footBtn">
                <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Comprando</a>
                <?php if ($this->cart->total_items() > 0) { ?>
                    <a href="index.php?c=order&a=placeOrder" class="btn btn-success orderBtn">Realizar pedido <i class="glyphicon glyphicon-menu-right"></i></a>
                <?php } ?>
            </div>
        </div>
        <div class="panel-footer">AulaMatriz</div>
    </div><!--Panek cierra-->
</div>
</body>

</html>