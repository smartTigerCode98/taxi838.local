
<link rel="stylesheet" href="../../webroot/css/user/admin/account.css" media="screen" type="text/css" />


    <table>
        <tr>
            <th>Назва таблиці</th>
            <th>Дія</th>
        </tr>
        <?php foreach ($data['tables'] as $table=>$name):?>
            <tr>
                <td><?=$name['name']?></td>
                <td><a href=" /admin/show/<?=$table?>">Перегляд</a>
            </tr>
        <?php endforeach; ?>
    </table>


