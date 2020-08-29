CREATE TABLE `tb_portfolio` (
  `idportfolio` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `titulo` varchar(124) NOT NULL,
  `descricao` VARCHAR(300) NOT NULL,
  `desurl` varchar(128) NOT NULL,
  `dtcadastro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idportfolio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8