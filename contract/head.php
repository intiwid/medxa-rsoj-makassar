<style type="text/css">
  .displayBlok {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: #9191914f;
  }

  .spinner {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 1;
    height: 40px;
    width: 40px;
    transform: translate(-50%, -50%);
  }

  [class^="ball-"] {
    position: absolute;
    display: block;
    left: 30px;
    width: 12px;
    height: 12px;
    border-radius: 6px;
    transition: all 0.5s;
    animation: circleRotate 4s both infinite;
    transform-origin: 0 250% 0;
  }

  @keyframes circleRotate {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(1440deg);
    }
  }

  .ball-1 {
    z-index: -1;
    background-color: red;
    animation-timing-function: cubic-bezier(0.5, 0.3, 0.9, 0.9);
  }

  .ball-2 {
    z-index: -2;
    background-color: #f46903;
    animation-timing-function: cubic-bezier(0.5, 0.6, 0.9, 0.9);
  }

  .ball-3 {
    z-index: -3;
    background-color: #00bcd4;
    animation-timing-function: cubic-bezier(0.5, 0.9, 0.9, 0.9);
  }

  .ball-4 {
    z-index: -4;
    background-color: #009688;
    animation-timing-function: cubic-bezier(0.5, 1.2, 0.9, 0.9);
  }

  .ball-5 {
    z-index: -5;
    background-color: #4caf50;
    animation-timing-function: cubic-bezier(0.5, 1.5, 0.9, 0.9);
  }

  .ball-6 {
    z-index: -6;
    background-color: #8bc34a;
    animation-timing-function: cubic-bezier(0.5, 1.8, 0.9, 0.9);
  }

  .ball-7 {
    z-index: -7;
    background-color: #cddc39;
    animation-timing-function: cubic-bezier(0.5, 2.1, 0.9, 0.9);
  }

  .ball-8 {
    z-index: -8;
    background-color: #ffeb3b;
    animation-timing-function: cubic-bezier(0.5, 2.4, 0.9, 0.9);
  }
</style>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css">
<link href="../css/mdb.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/dataTables.min.css">
<link rel="stylesheet" href="css/jquery-ui.css" />
<link rel="icon" href="../image/ipi-icon3.png" type="image/png">
<link rel="stylesheet" href="fontawesome/css/all.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
<link rel="stylesheet" href="css/bootstrap-select.min.css">
<link rel="stylesheet" href="../css/style_master.css">
<link rel="stylesheet" href="css/css_media.css">