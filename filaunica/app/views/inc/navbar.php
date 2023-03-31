<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark md-3" style="margin-bottom:10px;">
    <div class="container">
        
        <a class="navbar-brand" href="<?php echo URLROOT; ?>/pages/sistem"><?php echo SITENAME; ?></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          
              <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo URLROOT; ?>/pages/sistem">Início</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">Sobre</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo URLROOT; ?>/admins">Fila</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Relatórios
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                          <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/relatorioMensal">Relatorio de Matrículas Mensal</a> 
                          <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/relatorioDemanda">Relatorio de Demanda por Unidade</a>                                                            
                          <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/relatorioAlunoEspecial">Relatorio de Alunos Especiais</a>
                          <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/relatorioAguardandoAlfabetica">Relatorio Aguardando Alfabética</a>
                        </div>
                      </li>
                    
                            

                <!--FAZ A VERIFICAÇÃO SE O USUÁRIO É ADMINISTRADOR, SE SIM CARREGA OS MENUS DE CADASTRO-->
                  <?php if(isset($_SESSION[DB_NAME . '_user_type']) && ($_SESSION[DB_NAME . '_user_type']) == "admin") : ?>           
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Cadastros
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                          <a class="dropdown-item" href="<?php echo URLROOT; ?>/users">Usuários</a>
                          <a class="dropdown-item" href="<?php echo URLROOT; ?>/etapas">Etapas</a>                                   
                        </div>
                      </li>
                  <?php endif; ?>         
              
              
              </ul>


              <ul class="navbar-nav ml-auto">
                  <?php if(isset($_SESSION[DB_NAME . '_user_id'])) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Bem vindo <?php echo $_SESSION[DB_NAME . '_user_name']; ?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Sair</a>
                    </li>
                  <?php else : ?>          
                    <li class="nav-item">                      
                    </li> 
                    <li class="nav-item">                      
                    </li>
                  <?php endif; ?>         
              </ul>

        </div>
    </div>
</nav>