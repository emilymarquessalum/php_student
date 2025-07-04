<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'teacher') {
    header('Location: ../login.php');
    exit();
}

// Dados de exemplo das turmas (em uma aplicação real, viriam do banco de dados)
$classes = [
    ['id' => 1, 'name' => 'Matemática 101', 'room' => 'Sala A1', 'days' => 'Segunda, Quarta'],
    ['id' => 2, 'name' => 'Física 201', 'room' => 'Sala B2', 'days' => 'Terça, Quinta'],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor - Sistema de Presença QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Painel do Professor</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../logout.php">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Minhas Turmas</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome da Turma</th>
                                        <th>Sala</th>
                                        <th>Dias</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($classes as $class): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($class['name']); ?></td>
                                        <td><?php echo htmlspecialchars($class['room']); ?></td>
                                        <td><?php echo htmlspecialchars($class['days']); ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" 
                                                    onclick="generateQRCode('<?php echo $class['id']; ?>')">
                                                Gerar QR Code
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>QR Code</h3>
                    </div>
                    <div class="card-body text-center">
                        <div id="qrcode"></div>
                        <p class="mt-3" id="qrMessage">Clique em "Gerar QR Code" para criar o código de presença.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateQRCode(classId) {
            const timestamp = Date.now();
            const attendanceData = {
                classId: classId,
                timestamp: timestamp,
                token: btoa(`${classId}-${timestamp}`) // Geração simples de token
            };
            
            // Limpa QR code anterior
            document.getElementById('qrcode').innerHTML = '';
            
            // Gera novo QR code
            new QRCode(document.getElementById('qrcode'), {
                text: JSON.stringify(attendanceData),
                width: 200,
                height: 200
            });
            
            document.getElementById('qrMessage').textContent = 'QR Code gerado! Válido para registro de presença.';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>