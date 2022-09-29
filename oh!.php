<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Cipher - IP NA
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
</head>
<style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Press+Start+2P');
html, body {
  width: 100%;
  height: 100%;
  margin: 0;
}
* {
  font-family: 'Press Start 2P', cursive;
  box-sizing: border-box;
}
#app {
  padding: 1rem;
  background-image: url("assets/img/bill.png");
  background-size: 100%;
  display: flex;
  height: 100%;
  justify-content: center;
  align-items: center;
  color: #701010;
  text-shadow: 0px 0px 10px;
  font-size: 6rem;
  flex-direction: column;
}
#app .txt {
  font-size: 1.3rem;
}
@keyframes blink {
  0% {
    opacity: 0;
  }
  49% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 1;
  }
}
.blink {
  animation-name: blink;
  animation-duration: 1s;
  animation-iteration-count: infinite;
}

</style>
<body>
<div id="app">
   <div>403</div>
   <div class="txt">
      On dirait que votre IP n'est pas autorisée à accéder à ce contenu<span class="blink"> :(</span>
   </div>
</div>
</body>
</html>