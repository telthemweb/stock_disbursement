<?php 
function CSRFToken()
{
    echo $_SESSION['_crsftoken'];
}