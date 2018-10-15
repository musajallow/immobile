<?php

class Header extends Base_controller {
    
    private $title;
    private $navBarName;
    private $content;


    public function setTitle(string $title) {
        $this->title=$title;
    }

    public function setNavBarName(string $navBarName) {
        $this->navBarName=$navBarName;
    }

    public function setContent(string $content) {
        $this->content=$content;
    }

    
    public function displayHeader() {
        echo '<ul class="nav navbar-nav navbar-right">';
        echo '<a href="index.php">Home</a>';
        echo '<a href="#">My account</a>';
        echo '<a href="Products.view.php">All products</a>';
        echo '<a href="#">Logout</a>';
        echo '</ul>';
    }
}