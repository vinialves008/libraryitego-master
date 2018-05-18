CREATE PROCEDURE `libraryitego`.`sp_curso_turma_insert` (pinicio datetime, ptermino datetime, pidcurso int)
BEGIN
insert into turma (data_inicio, data_termino, curso_idcurso)
values (pinicio , ptermino , pidcurso );

select idturma, data_inicio, data_termino, curso_idcurso from turma where idturma = LAST_INSERT_ID();

END