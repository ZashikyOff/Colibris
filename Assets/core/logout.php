<?php
session_name("colibris");
session_start();
session_destroy();
header("Location: ../../index.php");
