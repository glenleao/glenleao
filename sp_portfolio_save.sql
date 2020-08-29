CREATE PROCEDURE `sp_portfolio_save`(
pidportfolio INT(11),
pnome VARCHAR(64),
ptitulo VARCHAR(124),
pdescricao VARCHAR (300),
pdesurl VARCHAR(128)
)
BEGIN
    
    IF pidportfolio > 0 THEN
        
        UPDATE tb_portfolio
        SET 
            nome = pnome,
            titulo = ptitulo,
            descricao = pdescricao,
            desurl = pdesurl
        WHERE idportfolio = pidportfolio;
        
    ELSE
        
        INSERT INTO tb_portfolio (idportfolio, nome, titulo, descricao, desurl) VALUES(pidportfolio, pnome, ptitulo, pdescricao, pdesurl);
        
        SET pidportfolio = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_portfolio WHERE idportfolio = pidportfolio;
    
END