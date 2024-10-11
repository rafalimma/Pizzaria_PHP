<?php
    include_once("php_templates/header.php");
?>
    <div id="main-banner">
        <h1>Faça seu pedipdo</h1>
    </div>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Monte a pizza como desejar</h2>
                    <form method="POST" action="core/pizza.php" id="pizza-form">
                        <div class="form-group">
                            <label for="borda">Borda:</label>
                            <select name="borda" id="borda" class="form-control">
                                <option value="">Selecione a borda</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="massa">Massa:</label>
                            <select name="massa" id="massa" class="form-control">
                                <option value="">Selecione a massa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sabores">Sabor: (máximo 3)</label>
                            <select multiple name="sabores[]" id="sabores" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Fazer pedido">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <i class="fas fa-sync-alt"></i>

<?php
    include_once("php_templates/footer.php");
?>