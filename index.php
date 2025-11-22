<?php include('layout/header.php'); ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Descubra seu Signo</h1>

    <div class="card shadow p-4">
        <form id="signo-form" method="POST" action="show_zodiac.php">
            <label for="data_nascimento" class="form-label">Selecione sua data de nascimento:</label>
            <input type="date" name="data_nascimento" class="form-control mb-3" required>
            
            <button type="submit" class="btn btn-primary w-100">Ver meu signo</button>
        </form>
    </div>
</div>

</body>
</html>
