<?php

include_once "php/checkLoginStatus.php";

if ($user_ok != true){
    header('Location: index.php');
}

?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Jadu Heart | Admin Panel</title>
  <meta name="description" content="Jadu Heart Admin">

  <link rel="stylesheet" href="style/main.css">

</head>

<body>
    <header>
        <img src="../img/logo.png" alt="Jadu Heart">
    </header>
    <main>
        <h2>Welcome back</h2>
        <section id="subscribers">
            <h3>Manage subcribers</h3>
            <ul id="subscriberList">
                <li id="1">
                    <p><span>1</span>markb1994@icloud.com</p>
                    <button class="removeThis">x</button>
                </li>
                <li id="2">
                    <p><span>2</span>markb1994@icloud.com</p>
                    <button class="removeThis">x</button>
                </li>
                <li id="3">
                    <p><span>3</span>markb1994@icloud.com</p>
                    <button class="removeThis">x</button>
                </li>
            </ul>
            <button id="subExport">export</button>
            <button id="subEmail">send message</button>
        </section>

        <section id="manageDimensions">
            <h3>Manage Dimensions</h3>
            <ul id="dimensionList">
                <li id="1">
                    <img src="" alt="dimensionTitle">
                    <p>Dimension Title</p>
                    <p>Type</p>
                    <button class="removeThis">x</button>
                </li>
                <li id="2">
                    <img src="" alt="dimensionTitle">
                    <p>Dimension Title</p>
                    <p>Type</p>
                    <button class="removeThis">x</button>
                </li>
                <li id="3">
                    <img src="" alt="dimensionTitle">
                    <p>Dimension Title</p>
                    <p>Type</p>
                    <button class="removeThis">x</button>
                </li>
            </ul>
            <button id="addDimensionViewButton">add</button>
            <p>*only the 7 most recent dimensions will be displayed.</p>
        </section>
    </main>
    <section id="addDimensionView">
        <h2>Add Dimension</h2>
        <form id="newDimension">
            <input type="text" id="title" placeholder="Title">
            <input type="text" id="body" placeholder="Body or Embed Link">
            <p>type</p>
            <label class="container">Text
                    <input type="radio" checked name="dimensionType" value="text">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Media
                    <input type="radio" name="dimensionType" value="media">
                    <span class="checkmark"></span>
                </label>
        </form>
        <form id="imageUpload" enctype="multipart/form-data">
            <div class="uploadInput" id="uploadInput">
                <input class="uploadFile" type="file" name="image" id="file"/>
                <label for="file" id="fileLabel">
                    <img src="../img/photoIcon.png" width="40" class="uploadIcon" alt="photo icon">
                    <p><b>Choose a file</b><br>or drag a file here</p>
                </label>
            </div>
        </form>
        <button id="closeDimension">Cancel</button>
        <button id="addDimension">Add</button>
    </section>
    <a href="php/logout.php">Logout</a>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>