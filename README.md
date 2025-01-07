PROYECTO SUDOKU

Este es un proyecto web desarrollado en PHP nativo que permite a los usuarios jugar al Sudoku, visualizar rankings, y disfrutar de una experiencia personalizada con un diseño interactivo y funcional.

CARACTERÍSTICAS PRINCIPALES

- Generación de tableros de Sudoku con tres niveles de dificultad: Fácil, Medio y Difícil.
- Ranking local para cada nivel y un ranking global que muestra los mejores puntajes.
- Resaltado interactivo en el tablero para mejorar la jugabilidad.
- Cronómetro en tiempo real para medir el tiempo de resolución.
- Guardado y validación de puntajes en una base de datos.
- Diseño responsivo y personalizable utilizando Bootstrap y CSS.

---

TECNOLOGÍAS UTILIZADAS

- Backend: PHP 8
- Frontend: HTML5, CSS3, Bootstrap 5, Font Awesome
- Base de datos: MySQL
- Librerías adicionales: SweetAlert2 para mensajes interactivos.

---

INSTALACIÓN Y CONFIGURACIÓN

1. Clona el repositorio:
   git clone https://github.com/tuusuario/sudoku.git
   cd sudoku

2. Configura la base de datos:
- Crea una base de datos llamada sudoku.
- Importa el archivo sudoku.sql en tu base de datos:
   mysql -u root -p sudoku < sudoku.sql

3. Configura el archivo config.php: Ajusta las credenciales de la base de datos si es necesario:
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'sudoku');

4. Asegúrate de que tu servidor web tenga activado el módulo mod_rewrite (para Apache).

---

USO

1. Accede al proyecto a través de tu navegador:
   http://localhost/sudoku/

2. Ingresa un nombre de usuario, selecciona una dificultad y comienza a jugar.

3. Explora las características como el ranking global y validaciones interactivas.

---

CONTRIBUCIONES

¡Las contribuciones son bienvenidas! Si deseas mejorar el proyecto:

1. Realiza un fork del repositorio.

2. Crea una nueva rama para tu funcionalidad:
   git checkout -b feature/nueva-funcionalidad

3. Realiza un pull request con tus cambios.

---

LICENCIA
Este proyecto está licenciado bajo la GNU GENERAL PUBLIC LICENSE Versión 3.

---

CRÉDITOS

Proyecto desarrollado por juanrivas007 y Whatever