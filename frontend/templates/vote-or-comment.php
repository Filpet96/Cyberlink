<?php
if ((isset($_POST["voteUp"])) || (isset($_POST["voteDown"]))) {
    header("location: ../../home");
} else {
    echo "working";
}
