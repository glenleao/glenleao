DELIMITER $$
CREATE PROCEDURE `sp_contact_save` (
pid INT,
pnome VARCHAR(64),
pemail VARCHAR(64),
pmensagem TEXT,
pdtcadastro TIMESTAMP
)
BEGIN
	
	IF pid > 0 THEN
		
		UPDATE tb_contacts
        SET 
        	nome = pnome,
        	email = pemail,
        	mensagem = pmensagem,
        	dtcadastro = pdtcadastro
        WHERE id = pid;
        
    ELSE
		
		INSERT INTO tb_contacts (id, nome, email, mensagem, dtcadastro) VALUES(pid, pnome, pemail, pmensagem, pdtcadastro);
        
        SET pid = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_contacts WHERE id = pid;
    
END$$

DELIMITER ;




