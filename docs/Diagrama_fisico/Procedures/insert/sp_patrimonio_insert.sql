CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_patrimonio_insert`(pidpatrimonio int, plivro_idlivro int)
BEGIN

insert into patrimonio (idpatrimonio, livro_idlivro)
values (pidpatrimonio, plivro_idlivro);

select idpatrimonio, livro_idlivro from patrimonio where idpatrimonio = pidpatrimonio;
END