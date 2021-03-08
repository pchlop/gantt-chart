<?php

    //session_start();


    if(!(isset($_SESSION['login'])))
    {
        echo
            '<nav>
            <h1 class="logo">Wykresy Gantta</h1>
                    <ul class="navigation" id="navigation">
                        <li><a href="index.php">Strona główna</a></li>
                        <li><a href="#">O projekcie</a></li>
                        <li><a class="theme1" href="asstes/themeswitcher.php?choice=style"><i class="las la-sun"></i></a>
                        <a class="theme2" href="asstes/themeswitcher.php?choice=style2"><i class="las la-moon"></i></a></li>
                        </ul>
                        
            </nav>';
          //<a href="#" class="menu" id="menu">MENU</a>
    }
    else 
    {
        echo
            '<nav>
                <!-- CTRL+SHIFT+A = komentarz -->
                <h1 class="logo">Wykresy Gantta</h1>
                
                    <ul class="navigation" id="navigation">
                        <li><p>Zalogowany: '.$_SESSION['login'].'</p></li>
                        <li><a href="index.php">Strona główna</a></li>
                        <li><a href="#">O projekcie</a></li>
                        <li><a class="theme1" href="asstes/themeswitcher.php?choice=style"><i class="las la-sun"></i></a>
                        <a class="theme2" href="asstes/themeswitcher.php?choice=style2"><i class="las la-moon"></i></a></li>
                        <li><a href="logout.php">WYLOGUJ</a></li>
                        
                    </ul>
            </nav>';
    }

?>