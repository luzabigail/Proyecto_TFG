Integrantes del grupo: 

    Diego Ciro Ayala
    Luz Bietti

Proyecto: 

    Film to Read

Tecnologias aplicadas:

    PHP
    HTML
    JavaScript
    CSS
    SQL

Implementación por puntos: 

Según lo exigido a continuación explicaremos lo que hemos hecho en casa uno de los puntos aplicado a nuestra página 
para que tuviera sentido con la distribución y el estilo que tenemos en mente.

1 - La primera mejora obligatoria está realizada ya que los usuarios se autentifican con una contraseña cifrada, además de poder 
darse de alta en caso de no estarlo, todo esto realizando ordenes a la base de datos (tabla usuarios). 
<la contraseña de todos es 1234 para hacer las pruebas>
La sesión se cerrará automaticamente tras 10 minutos de no cargar algún recurso. Cuando se caduca la sesión o simplemente el usuario la cierra, lo devolverá automaticamente a la pagina principal (index), desde donde podrá volver a inciar sesión en el menú hamburguesa.

2 - Esta parte en nuestra página era más complicada de implementar. Lo que decidimos es que, cuando el usuario esté logeado, en el index tenga un mensaje de bienvenida con su nombre. Además, en el menú hamburguesa saldrá una nueva opción que no sale si no está el usuario activo (a parte de cerrar sesión) que es "favoritos". Esta opción está por defecto vacia hasta que el usuario añada contenido, siendo personalizado para cada uno de los usuarios guardandose en la base de datos (guardados). Además, hemos implementado una funcionalidad más, y es que, en cada pagina de pelicula y libro hay una caja de comentarios y valoración, las cuales son visibles para todo el que entra, pero si el usuario quiere dejar una valoración con su reseña obligatoriamente debe estár registrado. Lo mismo ocurre cuando presionan el botón de favoritos, si no está registrado se dirige al login. 

3 - El registro de nuevos usuarios está implementado desde el login en "No tengo cuenta" (¿olvido su contraseña es? es estetico, no tiene función) llevandole a la pagina de registro "registro.php" desde donde pondra nombre, contraseña y un e-mail que se guardará en la base de datos en la tabla usuarios. 

4 - Como comentabamos antes, los favoritos pueden ser modificados añadiendo las peliculas o libros que guste el usuario. además también la creación de comentarios con el nombre de quién los realiza. 

5 - El acceso directo a la web es como invitado por defecto, pudiendo acceder a casi todo el contenido de la web salvo a los favoritos que son para cada usuario de forma única y privada y la publicación de comentarios. 

6 - La mejora que hemos propuesto está descrita anteriormente, pero es el sistema de guardado de favoritos mediante el botón con forma de corazón, que hay en cada una de las paginas, creando una interfaz personalizada en el apartado "Mis favoritos" que corresponde a guardados.php, además estando cada uno de los elementos guardados unido a su pagina propia, la cual es accesible solo presionando la imagen. 

notas finales a destacar: aunque no se haga referencia directa a ello, todas las fotos pertenecientes a películas y libros se obtienen desde la base de datos, incluidas las portadas principales, siendo esta ultima la tabla portadas pero la principal donde está el grupo de imagenes es la tabla material. Destacar también que los comentarios se separaron en su propia tabla para que fuera más simple de manejar así como los elementos guardados, evitando tenemos excesiva información en la misma tabla. 