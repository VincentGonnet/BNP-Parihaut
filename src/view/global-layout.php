<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BNP Parihaut</title>
        <link rel="stylesheet" href="style/global-style.css">
        <link rel="stylesheet" href="style/stats-style.css">
        <link rel="stylesheet" href="style/new-client-style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <script src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    
    <body>
        <nav>
            <?= $nav ?>
        </nav>
        
        <div>
            <header>
                <?= $head ?>
            </header>
            <main>
                <?= $view ?>
            </main>
        </div>
    </body>
</html>