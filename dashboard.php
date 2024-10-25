<?php
    include_once("php_templates/header.php");
?>

    <style>
        .delete-btn, .update-btn {
        border: none;
        background-color: transparent;
        }
        .delete-btn {
        padding-top: 10px;
        }
        .delete-btn i {
        color: red;
        font-size: 20px;
        }
        .update-btn i {
        color: #004085;
        }
        .update-form {
        display: flex;
        flex-direction: row;
        }
        .status-input {
            width: 65%;
        }
        .table {
            text-align: left;
        }
    </style>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Gerenciar Pedidos:</h2>
                </div>
                <div class="col-md-12 table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><span>Pedido</span>#</th>
                                <th scope="col"><span>Borda</span>#</th>
                                <th scope="col"><span>Massa</span>#</th>
                                <th scope="col"><span>Sabores</span>#</th>
                                <th scope="col"><span>Ações</span>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1</td>
                                <td>Cheddar</td>
                                <td>Catupiry</td>
                                <td>4 Queijos</td>
                                <td>
                                    <form action="core/order.php" method="POST" class="form-group update-form">
                                        <input type="hidden" name="type" value="update">
                                        <input type="hidden" name="id" value="1">
                                        <select name="status" class="form-control">
                                            <option value="">Entrega</option>
                                        </select>
                                        <button type="submit" class="update-btn">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>

                                </td>
                                <td>
                                    <form action="core/orders.php" method="POST">
                                        <input type="hidden" name="type" value="delete">
                                        <input type="hidden" name="id" value="1">
                                        <button type="submit" class="update-btn">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once("php_templates/footer.php");
?>