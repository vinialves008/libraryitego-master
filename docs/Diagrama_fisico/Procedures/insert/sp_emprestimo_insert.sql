CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_emprestimo_insert`(ppatrimonio int, pusuario int)
BEGIN
insert into emprestimo (data_emprestimo, data_devolucao, patrimonio_idpatrimonio, usuario_idusuario)
values(now(), now(), ppatrimonio, pusuario);

select idemprestimo, patrimonio_idpatrimonio, usuario_idusuario from emprestimo where idemprestimo = LAST_INSERT_ID();
END