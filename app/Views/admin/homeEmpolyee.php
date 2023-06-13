<?php $this->layout('admin::master', ['title' => $title]) ?>

<div class="container py-5">
    <?php if (isset($_SESSION['flash']['successDelete'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo getFlashMessage('successDelete'); ?>
        </div>
    <?php elseif (isset($_SESSION['flash']['errorDelete'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo getFlashMessage('errorDelete'); ?>
        </div>
    <?php endif; ?>
    <h1 class="text-danger text-center">Gestão de Funcionarios</h1>
    <a href="/admin/empolyee/create" class="btn btn-success">Adicionar Funcionarios</a>
   
   
    <table class="table text-center">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Acesso</th>
            <th>Permissões</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($data['empolyees'] as $index => $empolyee) : ?>
            <tr>
                <td><?php echo $empolyee['nameUser']; ?></td>
                <td><?php echo $empolyee['emailUser']; ?></td>
                <td><?php echo $empolyee['accessLevel']; ?></td>
                <td><?php echo $empolyee['permissions']; ?></td>
                <td>
                    <a href="/admin/car/edit/<?php echo $empolyee['idUser']; ?>" class="btn btn-warning">Editar</a>
                    <a href="/admin/car/delete/<?php echo $empolyee['idUser']; ?>" class="btn btn-danger">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>