<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">

            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="index.php">Inicio</a></li>
                <li role="presentation"><a href="index.php?c=cart">Ver Carta</a></li>
                <li role="presentation"><a href="index.php?c=payment">Pagos</a></li>
                <li role="presentation"><a href="index.php?c=product&a=Create">Crear Productos</a></li>
            </ul>
        </div>

        <div class="panel-body">
            <h1>Mis Productos</h1>
            <?php if ($this->cart->total_items() > 0) { ?>
                <a href="index.php?c=cart" class="cart-link" title="Ver Carta">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                </a>
            <?php } ?>

            <div id="products" class="row list-group">
                <?php foreach ($this->product->getAll() as $row) { ?>
                    <div class="item col-lg-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                                <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="lead"><?php echo '$' . $row["price"] . ' USD'; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-success" href="index.php?c=cart&a=addToCart&id=<?php echo $row["id"]; ?>">Agregar a la Carta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="panel-footer">AulaMatriz</div>
    </div>

</div>
</body>

</html>