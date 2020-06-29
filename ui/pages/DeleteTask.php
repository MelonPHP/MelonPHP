<?php

require_once(__DIR__ . "/../../backend/include.php");

TaskController::GetInstance()->DeleteTask($_GET["task_id"]);

Controller::RedirectTo("ProjectPage.php?splash=false&splash_tasks=false&id=".$_GET["project_id"]."&folder_id=".$_GET["folder_id"]);
