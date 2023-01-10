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
            <h1>Crear Producto</h1>
            <?php
                if (!empty($this->session->getSession()["error"])) {
                    echo "<div class='alert alert-danger'>".$this->session->getSession()["error"]."</div>";
                }
            ?>
            <form action="index.php?c=product&a=Create" method="POST">
                <div class="row">
                    <div class="col-md-1">
                        Nombre:
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="name" placeholder="Nombre de producto" 
                        <?php
                            if($this->product->name){
                                echo "value='".$this->product->name."' ";
                            }
                        ?> required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        Descripcion:
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="description" placeholder="Descripcion de producto"
                        <?php
                            if($this->product->description){
                                echo "value='".$this->product->description."' ";
                            }
                        ?> required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        Precio:
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="price" placeholder="Precio de producto" <?php
                            if($this->product->price){
                                echo "value='".$this->product->price."' ";
                            }
                        ?> required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-success" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">AulaMatriz</div>
    </div>

</div>
</body>

</html>