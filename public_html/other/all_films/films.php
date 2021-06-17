<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Forum" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/films.css">
    <?php include "..//..//includes/bd.php"; ?>
    
    <title>Все фильмы</title>
</head>
<body>
    <?php include "..//..//includes/header.php" ?>
    
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="sect_head"><h1>Все фильмы</h1></div>
            </div>
            <?php 
                for ($i = 1; $i <= get_film_count(); $i++) {
                    if(!empty($_GET['genre']))
                    {
                        if($_GET['genre']==get_film_genre($i))
                        {
                            $id = $i;
                            include "..//..//includes/createblockfilm.php";
                        }
                    }
                    else
                    {
                        $id = $i;
                        include "..//..//includes/createblockfilm.php";
                    }
                }   
            ?>
            </div>
            
        </div>
    </section>
    
    <footer>
        
    </footer>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="js/all_films.js"></script>
</body>
</html>
