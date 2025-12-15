<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Sistema Controle OS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --azul: #1d3557;
            --azul-claro: #457b9d;
            --cinza-bg: #f4f6f9;
            --card-bg: #ffffff;

            --admin: #dc3545;
            --func: #198754;
            --tec: #fd7e14;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, sans-serif;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: var(--cinza-bg);
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            position: relative;
            background: linear-gradient(135deg, var(--azul), var(--azul-claro));
            color: #fff;
            padding: 50px 20px 80px;
            text-align: center;
        }

        header::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.12);
        }

        header * {
            position: relative;
            z-index: 1;
        }

        header h1 {
            font-size: 34px;
            margin-bottom: 8px;
        }

        header p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* MAIN */
        main {
            flex: 1;
            max-width: 1100px;
            margin: -60px auto 0;
            padding: 0 20px 40px;
        }

        /* CARDS EM LINHA */
        .cards {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        /* CARD */
        .card {
            min-width: 280px;
            max-width: 320px;
            background: var(--card-bg);
            border-radius: 18px;
            padding: 45px 30px;
            text-align: center;
            text-decoration: none;
            color: #333;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 6px;
            width: 100%;
            background: var(--azul);
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 55px rgba(0, 0, 0, 0.18);
        }

        /* ICON */
        .icon {
            width: 78px;
            height: 78px;
            margin: 0 auto 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #fff;
            position: relative;
        }

        .icon::after {
            content: "";
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            opacity: 0.25;
        }

        /* PERFIS */
        .admin::before,
        .admin .icon,
        .admin .icon::after {
            background: var(--admin);
        }

        .func::before,
        .func .icon,
        .func .icon::after {
            background: var(--func);
        }

        .tec::before,
        .tec .icon,
        .tec .icon::after {
            background: var(--tec);
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .card span {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
        }

        /* FOOTER */
        footer {
            background: #ffffff;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            padding: 18px 20px;
            text-align: center;
            font-size: 13px;
            color: #666;
        }

        footer span {
            font-weight: 600;
            color: #1d3557;
        }

        footer small {
            display: block;
            margin-top: 4px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>

    <header>
        <h1>Sistema Controle OS - Lucca</h1>
        <p>Selecione o tipo de acesso para continuar</p>
    </header>

    <main>
        <div class="cards">

            <a href="./controle_os_admin/src/view/acesso/login.php" class="card admin">
                <div class="icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <h3>Administrador</h3>
                <span>Gerenciamento completo do sistema</span>
            </a>

            <a href="./controle_os_funcionario/src/view/acesso/login.php" class="card func">
                <div class="icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                <h3>Funcionário</h3>
                <span>Abertura e acompanhamento de chamados</span>
            </a>

            <a href="./controle_os_tecnico/src/view/acesso/login.php" class="card tec">
                <div class="icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <h3>Técnico</h3>
                <span>Atendimento e resolução de chamados</span>
            </a>

        </div>
    </main>

    <footer>
         <strong>Copyright &copy; 2024 <a href="http://adminlte.io">Controle OS</a>.</strong> Todos os direitos reservados.
    </footer>

</body>
</html>
