<?php
require "utility/functions.php";
session_start();
$connection = mysql_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Sign Up";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- RENDER ----- ----- -----//
render("template_start");
render("navbar", $user, $user_permissions);
?>

<div class="jumbotron mt-5">
    <h1 class="display-4">Welcome, stranger!</h1>
    <p class="lead">This simple site is made to bring a little more good into our complex world. Here you can find ready-made homework with or without analysis, and also discuss any problem!
    <hr class="my-4">
    <p>Explore categories or use the search in the navigation bar to discover a new world.</p>
</div>
<div class="mb-5">
    <hr>
    <div class="form-row m-3">
        <div class="col-md-3">
            <img class="img-thumbnail" src="src/static/thumbnails/thumbnail_phplamp" alt="phplamp">
        </div>
        <div class="col-md-9">
            <h3>PHP LAMP</h3>
            <p>
                PHP (/pi:.eɪtʃ.pi:/ англ. PHP: Hypertext Preprocessor — «PHP: препроцессор гипертекста»; первоначально Personal Home Page Tools[8] — «Инструменты для создания персональных веб-страниц») — скриптовый язык[9] общего назначения, интенсивно применяемый для разработки веб-приложений. В настоящее время поддерживается подавляющим большинством хостинг-провайдеров и является одним из лидеров среди языков, применяющихся для создания динамических веб-сайтов[10].
            </p>
            <a class="btn btn-block btn-outline btn-primary" href="content_php.php">See More...</a>
        </div>
    </div>
    <hr>
    <div class="form-row m-3">
        <div class="col-md-9">
            <h3>C++</h3>
            <p>
                C++ (читается си-плюс-плюс[1][2]) — компилируемый, статически типизированный язык программирования общего назначения.
                Поддерживает такие парадигмы программирования, как процедурное программирование, объектно-ориентированное программирование, обобщённое программирование. Язык имеет богатую стандартную библиотеку, которая включает в себя распространённые контейнеры и алгоритмы, ввод-вывод, регулярные выражения, поддержку многопоточности и другие возможности. C++ сочетает свойства как высокоуровневых, так и низкоуровневых языков.[3][4] В сравнении с его предшественником — языком C, — наибольшее внимание уделено поддержке объектно-ориентированного и обобщённого программирования.[4]
            </p>
            <a class="btn btn-block btn-outline btn-primary" href="content_c++.php">See More...</a>
        </div>
        <div class="col-md-3">
            <img class="img-thumbnail" src="src/static/thumbnails/thumbnail_c++" alt="c++">
        </div>
    </div>
    <hr>
    <div class="form-row m-3">
        <div class="col-md-3">
            <img class="img-thumbnail" src="src/static/thumbnails/thumbnail_cti" alt="phplamp">
        </div>
        <div class="col-md-9">
            <h3>КТИ</h3>
            <p>КТИ - это полная жесть, у меня даже комментариев не хватило и уж точно не хватило найти какое нибудь нормальное описание, одним словом - полный кек!</p>
            <a class="btn btn-block btn-outline btn-primary" href="content_cti.php">See More...</a>
        </div>
    </div>
    <hr>
    <div class="form-row m-3">
        <div class="col-md-9">
            <h3>Coming soon...</h3>
            <p>
                Как будто мне больше нечем заняться, пока это все, но скоро (хех, нет) добавится много новой полезной (хех, тоже нет) инфы!
            </p>
        </div>
        <div class="col-md-3">
            <img class="img-thumbnail" src="src/static/thumbnails/thumbnail_cs" alt="c++">
        </div>
    </div>
</div>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>