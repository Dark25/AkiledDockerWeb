<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $config['hotelName'] ?> - Staff Login</title>
	<link rel="stylesheet" href="<?= $config['hotelUrl'] ?>/system/maintenance/css/maintenance-v2.css"
		media="screen and (prefers-color-scheme: light)">
	<link rel="stylesheet" href="<?= $config['hotelUrl'] ?>/system/maintenance/css/maintenance-v2-dark.css"
		media="screen and (prefers-color-scheme: dark)">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
	<div class="mesh-bg">
		<div class="mesh-ball ball-1"></div>
		<div class="mesh-ball ball-2"></div>
		<div class="mesh-ball ball-3"></div>
	</div>

	<div id="back1" class="bg-decor"></div>
	<div id="back2" class="bg-decor"></div>

	<div class="theme-toggle">
		<dark-mode-toggle id="dark-mode-toggle" appearance="toggle" dark="Oscuro" light="Claro" permanent="true">
		</dark-mode-toggle>
	</div>

	<div class="container">
		<div class="maintenance-tag">Access Control</div>
		<h1>Staff Login</h1>
		<p>Introduce tus credenciales para acceder al panel de administración.</p>

		<?php User::Login(); ?>

		<form method="post">
			<div class="input-group">
				<input type="text" id="username" name="username" placeholder="<?= $lang['Iusername'] ?>" required
					autofocus>
			</div>
			<div class="input-group">
				<input type="password" id="password" name="password" placeholder="<?= $lang['Ipassword'] ?>" required>
			</div>
			<button type="submit" class="submit" name="login">
				<?= $lang["Ilogin"] ?>
			</button>
		</form>

		<div class="box">
			<a href="index" class="staff-link">
				Volver al inicio
			</a>
		</div>

		<!-- Decorative pixels -->
		<div class="pixel-decor" style="top: 15%; left: 8%;"></div>
		<div class="pixel-decor" style="bottom: 10%; right: 12%; animation-delay: -3s;"></div>
	</div>

	<script type="module" src="https://unpkg.com/dark-mode-toggle"></script>
	<script>
		const toggle = document.querySelector('dark-mode-toggle');
		const body = document.body;

		const updateTheme = () => {
			if (toggle.mode === 'dark') {
				body.classList.remove('light-mode');
			} else {
				body.classList.add('light-mode');
			}
		};

		toggle.addEventListener('colorschemechange', updateTheme);
		window.addEventListener('DOMContentLoaded', updateTheme);
	</script>
</body>

</html>