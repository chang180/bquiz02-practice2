<?php
include_once "../base.php";

$subject = $_POST['subject'];

if (!empty($subject)) {
    $Que->save(['text' => $subject, 'parent' => 0]);
    $parent = $Que->find(['text' => $subject])['id'];

    if (!empty($_POST['option'])) {
        foreach ($_POST['option'] as $opt) {
            $Que->save(['text' => $opt, 'parent' => $parent]);
        }
    }
}
to("../admin.php?do=que");
