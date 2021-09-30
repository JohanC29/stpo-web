--  Estados en la base de datos

INSERT INTO `estado` (`est_codigo`, `est_descripcion`) 
    VALUES ('0', 'Inactivo'), ('1', 'Activo');

--  Insert en tabla Empleados

INSERT INTO `empleado` (`emp_codigo`, `emp_nombre`, `emp_apellido`, `emp_cedula`, `emp_cargo`, `est_codigo`) 
VALUES ('1', 'Administrador ', '1', '-1', 'Administrador', '1');

INSERT INTO `empleado` (`emp_codigo`, `emp_nombre`, `emp_apellido`, `emp_cedula`, `emp_cargo`, `est_codigo`) 
VALUES ('2', 'WILLIAN ', 'MELO', '-1', 'Operario', '1'),
       ('3', 'ALEJANDRO ', 'VALENCIA', '-1', 'Operario', '1'),
       ('4', 'JUAN CARLOS ', 'HOLGUIN', '-1', 'Operario', '1')
;

-- Insert en tabla Maquina

INSERT INTO `maquina` (`maq_codigo`, `maq_identificador`, `maq_nombre`, `est_codigo`) 
VALUES  ('1', 'Cotub1', 'Cortadora de tubos', '1'), 
        ('2', 'Tcnc1', 'Torno CNC', '1');

-- Insert en tabla Proceso

INSERT INTO `proceso` (`pro_codigo`, `pro_identificador`, `pro_nombre`, `est_codigo`) 
VALUES ('1', '001', 'Corte tubo metalico', '1');

INSERT INTO `proceso` (`pro_codigo`, `pro_identificador`, `pro_nombre`, `est_codigo`) 
VALUES  ('2', '002', 'Corte tubo plastico', '1'),
        ('3', '003', 'Mecanizado ejes', '1'),
        ('4', '004', 'Mecanizado tubos', '1'),
        ('5', '005', 'Mecanizado general', '1')
;

-- INSERT INTO `proceso` (`pro_codigo`, `pro_identificador`, `pro_nombre`, `est_codigo`) 
-- VALUES ('1', '001', 'Corte tubo metalico', '1');


-- Insert en la tabla detalle proceso maquina

INSERT INTO `detalleprocesomaquina` (`dpm_codigo`, `maq_codigo`, `pro_codigo`) 
VALUES ('1', '1', '1');




---////

INSERT INTO `detalleproducto` (`dprod_codigo`, `pro_codigo`, `prod_codigo`) 
    VALUES 
    (NULL, '9', '20')
    ,(NULL, '14', '20')
    ,(NULL, '4', '20')
    ,(NULL, '3', '20')
    ,(NULL, '12', '20')
    ,(NULL, '11', '20')
    ,(NULL, '13', '20')
    ,(NULL, '17', '20')
    ,(NULL, '18', '20')
    ;





--////////7





-- Insert into select
INSERT INTO detalleordentrabajo(dotr_codigo,otr_codigo,pro_codigo,dotr_cantidad)
SELECT
null,
ot.otr_codigo,
dp.pro_codigo,
0
FROM 
ordentrabajo ot,
producto p,
detalleproducto dp
WHERE
ot.prod_codigo = p.prod_codigo
and dp.prod_codigo = p.prod_codigo
and ot.otr_codigo = 3; -- Codigo de la orden de trabajo  

