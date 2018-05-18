-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE  PROCEDURE `sp_usuario_senha_insert`(psenha_usuario text, pdata_cadastro datetime, pusuario int)
BEGIN
insert into senha (senha_usuario, data_cadastro, usuario_idusuario)
values(psenha_usuario, pdata_cadastro, pusuario);
END
