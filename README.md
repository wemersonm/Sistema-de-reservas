Requisitos Funcionais:

1 - Registro de usuários: O sistema deve permitir que os usuários se registrem fornecendo informações básicas, como nome, endereço, número de telefone e endereço de e-mail.

2 - Pesquisa de carros disponíveis: Os usuários devem ser capazes de pesquisar e visualizar os carros disponíveis para reserva com base em critérios como localização, data e hora de retirada e devolução, tipo de carro e capacidade.

3 - Reserva de carros: Os usuários devem poder selecionar um carro disponível, especificar a data e a hora de retirada e devolução, e fazer a reserva através do sistema.

3 - Cancelamento de reserva: Os usuários devem ter a opção de cancelar uma reserva existente dentro de um determinado período de tempo antes da data de retirada programada.

5 - Gerenciamento de frota: O sistema deve permitir que os proprietários de carros adicionem, removam e atualizem informações sobre os carros disponíveis para reserva.

6 - Autenticação e segurança: O sistema deve fornecer recursos de autenticação seguros para proteger as informações dos usuários e impedir o acesso não autorizado.

7 - Histórico de reservas: Os usuários devem ter acesso ao histórico de suas reservas anteriores, incluindo detalhes como datas, horários, carros reservados e valores pagos.

8 - Pagamento: O sistema deve permitir que os usuários efetuem pagamentos online de forma segura para confirmar suas reservas.


colors
fundo #1b1a1f
letras #ad2323


PROCESSO  DE RESERVA

- USUARIO SELECIONA O CARRO DENTRE VARIOS LISTADOS ->
- REDIRECIONA PARA A PAGINA DO CARRO SELECIONADO ONDE VAI APARECER AS INFO DO CARRO E OS CAMPOS
  PARA INSERIR A RESERVA COM DATA E RESERVA E DATA DE DEVOLUÇAO.
- AO INSERIR DADOS E APERTAR NO BOTAO DE ALUGAR:
    * SE O USUARIO ESTIVER LOGADO E SE OS DADOS DO USUARIOS ESTÃO FORNECIDOS COMO cpf,endereço ... :
     - SETAR NO BANCO DE DADOS O CARRO COM AS INFO EM UMA TABELA DE 'CARRINHO' e associar ao user logado
     - REDIRECiONAR PARA PAGINA DE DETALHES COM O CARRO E AS INFO DE DATAS/PREÇOS/E INFO
    * SE NAO ESTIVER LOGADO:
     - SER REDIRECIONADO PARA PAGINA DE LOGIN/CADASTRO/ OU ABRIR UM MODAL PARA LOGIN/CADASTRO E VERIFICAR
       SE O USUARIO ESTÁ COM OS DADOS COMPLETOS FORNECIDOS como cpf,endreços etc ...
      - SETAR NO BANCO DE DADOS O CARRO COM AS INFO EM UMA TABELA DE 'CARRINHO' e associoar ao usuario
      - EXIBIR A PAGINA DE DETALHES COM O CARRO E AS INFO DE DATAS/PRECO E INFO
    * END
-   NA PAGINA DE DETALHES IRA TER UM BOTAO DE FAZER PAGAMENTO, ONDE SERA REDIRECIONADO PARA O CHECKOUT PRO DO
    MERCADO PAGO OU STRIPE
    .
    .
    .
    - AO PROCESSAR PAGAMENTO ADICIONAR O CARRO E DATALHES NA TABELA DE CARROS RESERVADOS 
    - ADIOCIONAR CARRO E DETALHES DA TABELA DE RESERVA E ASSOCIAR AO USUARIO 
    - NAS RESERVAS DO USARIO APARECER A OPCAO DE CANCELAR RESERVA SE O DIA/HORARIO NAO FOR MENOR DE 2 HORAS
    ANTES DO INICIO DA RESERVA 
    .
    .
    .
    *** painel adm ***
    . .
    ..
    

