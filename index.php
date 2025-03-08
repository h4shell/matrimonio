<?php
      require 'Database.php';
      $csvManager = new CsvManager('lista.csv');
      if (isset($_GET['name'])) {
        $nome = $_GET['name'];
        $res = $csvManager->recordExists($nome);
        if ($res) {
            header("Location: voted.html");
            exit();
        }
  
    } else {
        header("Location: voted.html");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="public/css/style.css" />
    <title>Document</title>
  </head>
  <body>
    <div id="leftbg"></div>
    <div id="rightbg"></div>
    <div class="wrapper">
      <h3 class="great-vibes text-center text-8xl color1 mt-12">Ginevra</h3>
      <p class=".fuggles text-center text-2xl color1">&</p>
      <h3 class="great-vibes text-center text-8xl color1">Lorenzo</h3>
      <p class="text-center mt-16 cormorant-garamond-700 text-2xl color2">
        hanno il piacere<br />di invitarvi al loro matrimonio
      </p>
      <p
        class="text-center mt-16 cormorant-garamond-700 text-2xl color2"
        id="name"
      >
      
    
    </p>
      <p class="text-center mt-12 cormorant-garamond-700 text-2xl color2">
        MAGGIO
      </p>
      <div
        class="super grid mt-12 text-center place-items-center w-[90%] mx-auto"
      >
        <p
          class="color2 border-t-2 border-b-2 border-[#B48B58] w-full py-4 cormorant-garamond-700 text-2xl"
        >
          SABATO
        </p>
        <p class="color1 fuggles text-6xl">10</p>
        <p
          class="color2 border-t-2 border-b-2 border-[#B48B58] w-full py-4 cormorant-garamond-700 text-2xl"
        >
          12:00 AM
        </p>
      </div>
      <p class="mt-8 text-center cormorant-garamond-700 text-2xl color2">
        2025
      </p>
      <p class="mt-8 text-center cormorant-garamond-700 text-2xl color2">
        Ca’ du Nonu, Str. Rivà 1<br />18012 Vallebona (IM)
      </p>
      <p class="fuggles color2 text-center text-5xl mt-4">
        ricevimento a seguire
      </p>
      <div class="container-button grid gap-4 place-items-center my-12">
        <button
          id="done"
          class="uppercase color2 cormorant-garamond-700 text-2xl py-2 border-2 border-[#B48B58] w-[80%] cursor-pointer"
        >
          parteciperò
        </button>
        <button
          id="decline"
          class="uppercase color2 cormorant-garamond-700 text-2xl py-2 border-2 border-[#B48B58] w-[80%] cursor-pointer"
        >
          non parteciperò
        </button>
      </div>
    </div>
    <script>
      const btnDone = document.getElementById("done");
      const btnDecline = document.getElementById("decline");
      function extractParams(url) {
        const urlObj = new URL(url);
        const params = new URLSearchParams(urlObj.search);
        const paramsObject = {};
        params.forEach((value, key) => {
          paramsObject[key] = value;
        });
        return paramsObject;
      }

      btnDone.addEventListener("click", async () => {
        try {
          const res = await fetch(
            `/handler.php?name=${params.name}&accept=true`
          );
          if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
          }
          const data = await res.text();

          window.location.href = "thank.html";
        } catch (error) {
          console.error("Error fetching data:", error);
        }
      });

      btnDecline.addEventListener("click", async () => {
        try {
          const res = await fetch(
            `/handler.php?name=${params.name}&accept=false`
          );
          if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
          }
          const data = await res.text();
          window.location.href = "sorry.html";
        } catch (error) {
          console.error("Error fetching data:", error);
        }
      });

      const params = extractParams(window.location.href);
      const name = document.getElementById("name");
      name.innerHTML = "A " + params.name;
      console.log(params);
    </script>
  </body>
</html>
