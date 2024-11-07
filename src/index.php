<?php
$blacklist = array(".", "..", ".git", ".vscode");
$itens = new DirectoryIterator('./');
$directories = [];
foreach ($itens as $item) {
    if ($item->gettype() === 'dir' && !in_array((string) $item->getFilename(), $blacklist)) {
        $diretoryId = array_push($directories, array("name" => $item->getFilename(), "subitens" => array())) - 1;
        $subitens = new DirectoryIterator('./' . $item->getFilename());
        foreach ($subitens as $subitem) {
            if ($subitem->gettype() === 'file') {
                array_push($directories[$diretoryId]["subitens"], array("name" => $subitem->getFilename(), "path" => $item->getFilename() . '/' . $subitem->getFilename()));
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h2>Pastas</h2>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <table>
                    <tbody>
                        <?php $count = 0;
                        foreach ($directories as $directory) { ?>
                            <tr>
                                <td id="folder_<?= ++$count ?>" class="folder" data-id="<?= $count ?>"><a href="<?= $directory["name"] ?>"><i
                                            class="material-icons">folder_open</i>
                                        <?= $directory["name"] ?></a></td>
                            </tr>
                            <?php foreach ($directory["subitens"] as $files) { ?>
                                <tr class="hide folder_<?= $count ?>">
                                    <td><a style="margin-left: 50px;" href="<?= $files["path"] ?>"><?= $files["name"] ?></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        window.addEventListener('load',()=>{
            const folders = document.querySelectorAll('.folder');

            for(const folder of folders){
                folder.addEventListener('click',function(){
                    const id = this.dataset.id;
                    const files = document.querySelectorAll('.folder_'+id);
                    for(const file of files){
                        if(file.classList.contains('hide')){
                        file.classList.remove('hide');
                        }else{
                            file.classList.add('hide');
                        }
                    }
                });
            }
        })
    </script>
</body>

</html>