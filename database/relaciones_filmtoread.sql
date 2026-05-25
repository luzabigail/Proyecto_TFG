-- Migración opcional para conectar tablas en una base filmtoread ya existente.
-- Si importas database/filmtoread.sql desde cero, NO necesitas ejecutar esto.

START TRANSACTION;

-- Guardados: se recrea la tabla para eliminar duplicados y añadir clave primaria + relaciones.
CREATE TABLE IF NOT EXISTS guardados_nuevo (
  usuario varchar(50) NOT NULL,
  id_material int(11) NOT NULL,
  PRIMARY KEY (usuario, id_material),
  KEY idx_guardados_material (id_material),
  CONSTRAINT fk_guardados_usuario FOREIGN KEY (usuario) REFERENCES usuarios(usuario)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_guardados_material FOREIGN KEY (id_material) REFERENCES material(id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO guardados_nuevo (usuario, id_material)
SELECT DISTINCT usuario, id_material
FROM guardados
WHERE usuario IN (SELECT usuario FROM usuarios)
  AND id_material IN (SELECT id FROM material);

DROP TABLE guardados;
RENAME TABLE guardados_nuevo TO guardados;

-- Comentarios: índices y relaciones.
ALTER TABLE comentarios
  ADD KEY idx_comentarios_material (id_material),
  ADD KEY idx_comentarios_usuario (usuario);

ALTER TABLE comentarios
  ADD CONSTRAINT fk_comentarios_material FOREIGN KEY (id_material) REFERENCES material(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT fk_comentarios_usuario FOREIGN KEY (usuario) REFERENCES usuarios(usuario)
    ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
